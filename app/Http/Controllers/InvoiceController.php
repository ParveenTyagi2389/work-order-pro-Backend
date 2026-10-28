<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoiceMail;
use App\Models\BillTo;
use App\Models\Invoice;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('billTo')
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = trim($request->search);
                $q->where(function ($sub) use ($term) {
                    $sub->where('invoice_number', 'like', "%{$term}%")
                        ->orWhereHas('billTo', fn($b) => $b->where('bill_name', 'like', "%{$term}%"));
                });
            })
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('bill_to_id'), fn($q) => $q->where('bill_to_id', $request->bill_to_id))
            ->when($request->filled('date_from'), fn($q) => $q->whereDate('invoice_date', '>=', $request->date_from))
            ->when($request->filled('date_to'), fn($q) => $q->whereDate('invoice_date', '<=', $request->date_to))
            ->latest('invoice_date');

        $summary = [
            'outstanding' => Invoice::whereNotIn('status', ['paid','cancelled'])->sum('total'),
            'paid_month' => Invoice::where('status','paid')->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year)->sum('total'),
            'overdue' => Invoice::where('status','overdue')->sum('total'),
            'count' => (clone $query)->count(),
        ];
        $invoices = $query->paginate(15)->withQueryString();
        $billTos = BillTo::orderBy('bill_name')->get();

        return view('invoices.index', compact('invoices','billTos','summary'));
    }

    public function create()
    {
        $invoice = null;
        $billTos = BillTo::orderBy('bill_name')->get();
        $workOrders = class_exists(WorkOrder::class) ? WorkOrder::latest('id')->limit(500)->get() : collect();
        $defaultEmail = '';
        return view('invoices.create', compact('invoice','billTos','workOrders','defaultEmail'));
    }

    public function store(Request $request)
    {
        $data = $this->validateInvoice($request);
        $items = $data['items']; unset($data['items']);
        $sendNow = $request->input('submit_action') === 'send';

        $invoice = DB::transaction(function () use ($data, $items) {
            $data['invoice_number'] = $this->generateInvoiceNumber();
            $totals = $this->calculateTotals($items, (float)$data['tax_rate'], (float)($data['discount'] ?? 0));
            $invoice = Invoice::create(array_merge($data, $totals));
            $invoice->items()->createMany($this->normalizeItems($items));
            return $invoice;
        });

        if ($sendNow) {
            return $this->send($request, $invoice);
        }

        return redirect()->route('invoices.show', $invoice)->with('success','Invoice saved as draft.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['billTo','items','workOrder']);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load('items','billTo');
        $billTos = BillTo::orderBy('bill_name')->get();
        $workOrders = class_exists(WorkOrder::class) ? WorkOrder::latest('id')->limit(500)->get() : collect();
        $defaultEmail = $invoice->recipient_email ?: $this->billingEmail($invoice->bill_to_id);
        return view('invoices.edit', compact('invoice','billTos','workOrders','defaultEmail'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $data = $this->validateInvoice($request);
        $items = $data['items']; unset($data['items']);
        $sendNow = $request->input('submit_action') === 'send';

        DB::transaction(function () use ($invoice, $data, $items) {
            unset($data['invoice_number']);
            $totals = $this->calculateTotals($items, (float)$data['tax_rate'], (float)($data['discount'] ?? 0));
            $invoice->update(array_merge($data, $totals));
            $invoice->items()->delete();
            $invoice->items()->createMany($this->normalizeItems($items));
        });

        if ($sendNow) return $this->send($request, $invoice->fresh());
        return redirect()->route('invoices.show', $invoice)->with('success','Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success','Invoice deleted successfully.');
    }

    public function send(Request $request, Invoice $invoice)
    {
        $request->validate([
            'recipient_email' => ['nullable','email','max:255'],
            'cc_email' => ['nullable','email','max:255'],
            'email_subject' => ['nullable','string','max:255'],
            'email_message' => ['nullable','string','max:5000'],
            'attach_pdf' => ['nullable','boolean'],
        ]);

        $invoice->load(['billTo','items','workOrder']);
        $recipient = $request->input('recipient_email') ?: $invoice->recipient_email ?: $this->billingEmail($invoice->bill_to_id);
        if (!$recipient) {
            return back()->withInput()->withErrors(['recipient_email' => 'Enter a recipient email address before sending.']);
        }

        $invoice->recipient_email = $recipient;
        $invoice->cc_email = $request->input('cc_email');
        $invoice->email_message = $request->input('email_message', $invoice->email_message ?: 'Hi, please find your invoice attached. Thank you for your business.');
        $invoice->attach_pdf = $request->boolean('attach_pdf');
        $invoice->save();

        try {
            $mailable = new SendInvoiceMail($invoice, $invoice->email_message);
            $mailable->subject($request->input('email_subject') ?: 'Invoice ' . $invoice->invoice_number . ' from ' . config('app.name', 'WorkOrder Pro'));
            $mail = Mail::to($recipient);
            if ($invoice->cc_email) $mail->cc($invoice->cc_email);
            $mail->send($mailable);
            $invoice->update(['status' => 'sent']);
        } catch (\Throwable $e) {
            report($e);
            return back()->withInput()->withErrors(['email' => 'Email could not be sent. Check your mail configuration and application logs.']);
        }

        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice emailed successfully to ' . $recipient . '.');
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $query = Invoice::with('billTo')
            ->when($request->filled('search'), fn($q) => $q->where('invoice_number','like','%'.$request->search.'%'))
            ->when($request->filled('status'), fn($q) => $q->where('status',$request->status));

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Invoice Number','Customer','Invoice Date','Due Date','Status','Subtotal','Tax','Total']);
            $query->orderByDesc('invoice_date')->chunk(200, function ($rows) use ($out) {
                foreach ($rows as $invoice) {
                    fputcsv($out, [
                        $invoice->invoice_number, $invoice->billTo->bill_name ?? '',
                        optional($invoice->invoice_date)->format('Y-m-d'),
                        optional($invoice->due_date)->format('Y-m-d'),
                        $invoice->status, $invoice->subtotal, $invoice->tax_amount, $invoice->total,
                    ]);
                }
            });
            fclose($out);
        }, 'invoices.csv', ['Content-Type' => 'text/csv']);
    }

    private function validateInvoice(Request $request): array
    {
        return $request->validate([
            'bill_to_id' => ['required','integer','exists:bill_tos,id'],
            'work_order_id' => ['nullable','integer'],
            'recipient_email' => ['nullable','email','max:255'],
            'cc_email' => ['nullable','email','max:255'],
            'invoice_date' => ['required','date'],
            'due_date' => ['nullable','date','after_or_equal:invoice_date'],
            'status' => ['required',Rule::in(['draft','sent','paid','overdue','cancelled'])],
            'tax_rate' => ['required','numeric','min:0','max:100'],
            'discount' => ['nullable','numeric','min:0'],
            'notes' => ['nullable','string','max:5000'],
            'email_message' => ['nullable','string','max:5000'],
            'attach_pdf' => ['nullable','boolean'],
            'send_reminder' => ['nullable','boolean'],
            'items' => ['required','array','min:1'],
            'items.*.description' => ['required','string','max:255'],
            'items.*.job_code' => ['nullable','string','max:100'],
            'items.*.quantity' => ['required','numeric','gt:0','max:99999999'],
            'items.*.unit_price' => ['required','numeric','min:0','max:9999999999'],
        ]);
    }

    private function normalizeItems(array $items): array
    {
        return collect($items)->map(function ($item) {
            $qty = round((float)$item['quantity'], 2);
            $price = round((float)$item['unit_price'], 2);
            return [
                'description' => $item['description'],
                'job_code' => $item['job_code'] ?? null,
                'quantity' => $qty,
                'unit_price' => $price,
                'line_total' => round($qty * $price, 2),
            ];
        })->all();
    }

    private function calculateTotals(array $items, float $taxRate, float $discount): array
    {
        $subtotal = 0;
        foreach ($items as $item) $subtotal += round((float)$item['quantity'] * (float)$item['unit_price'], 2);
        $discount = min(round($discount, 2), round($subtotal, 2));
        $taxable = max(0, $subtotal - $discount);
        $tax = round($taxable * $taxRate / 100, 2);
        return [
            'subtotal' => round($subtotal,2),
            'tax_amount' => $tax,
            'discount' => $discount,
            'total' => round($taxable + $tax,2),
        ];
    }

    private function generateInvoiceNumber(): string
    {
        do {
            $number = 'INV-' . now()->format('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(4)),0,6));
        } while (Invoice::where('invoice_number',$number)->exists());
        return $number;
    }

    private function billingEmail(int|string $billToId): ?string
    {
        // Adjust this query if your BillToEmail model/table uses different primary/foreign key names.
        try {
            if (class_exists(\App\Models\BillToEmail::class)) {
                $contact = \App\Models\BillToEmail::query()
                    ->where('bill_to', $billToId)
                    ->where('bill_active', 1)
                    ->orderBy('id')
                    ->first();
                return $contact?->bill_email;
            }
        } catch (\Throwable $e) {
            report($e);
        }
        return null;
    }
}
