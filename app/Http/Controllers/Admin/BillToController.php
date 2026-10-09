<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillToRequest;
use App\Models\BillTo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BillToController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));

        $billTos = BillTo::query()
            ->with(['emails' => fn ($q) => $q->orderBy('id')])
            ->withCount('sites')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('bill_name', 'like', "%{$search}%")
                        ->orWhere('bill_account', 'like', "%{$search}%")
                        ->orWhere('bill_phone', 'like', "%{$search}%");
                });
            })
            ->orderBy('bill_name')
            ->paginate(10)
            ->withQueryString();

        return view('backend.billing_account.index', [
            'billTos' => $billTos,
            'totalBillTos' => BillTo::count(),
            'activeBillTos' => BillTo::whereHas(
                'emails',
                fn ($q) => $q->where('bill_active', true)
            )->count(),
        ]);
    }

    public function create(): View
    {
        return view('backend.billing_account.create', [
            'billTo' => new BillTo(),
            'primaryEmail' => null,
        ]);
    }

    public function store(BillToRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $billTo = DB::transaction(function () use ($validated) {
            $billTo = BillTo::create([
                'bill_name' => $validated['bill_name'],
                'bill_travel' => $validated['bill_travel'] ?? null,
                'bill_labor' => $validated['bill_labor'] ?? null,
                'bill_fuel' => $validated['bill_fuel'] ?? null,
                'bill_address' => $validated['bill_address'] ?? null,
                'bill_account' => $validated['bill_account'] ?? null,
                'bill_po' => $validated['bill_po'] ?? null,
                'bill_city' => $validated['bill_city'] ?? null,
                'bill_state' => $validated['bill_state'] ?? null,
                'bill_zip' => $validated['bill_zip'] ?? null,
                'bill_phone' => $validated['bill_phone'] ?? null,
            ]);

            if (!empty($validated['contact_email'])) {
                $billTo->emails()->create([
                    'bill_email' => $validated['contact_email'],
                    'bill_name' => $validated['contact_name'] ?? null,
                    'bill_active' => (bool) ($validated['contact_active'] ?? false),
                ]);
            }

            return $billTo;
        });

        return redirect()->route('bill-to.show', $billTo)
            ->with('success', 'Billing account created successfully.');
    }

    public function show(BillTo $billTo): View
    {
        $billTo->load(['emails', 'sites'])->loadCount('sites');

        return view('backend.billing_account.show', compact('billTo'));
    }

    public function edit(BillTo $billTo): View
    {
        $billTo->load('emails');
        $primaryEmail = $billTo->emails->first();

        return view('backend.billing_account.edit', compact('billTo', 'primaryEmail'));
    }

    public function update(BillToRequest $request, BillTo $billTo): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $billTo) {
            $billTo->update([
                'bill_name' => $validated['bill_name'],
                'bill_travel' => $validated['bill_travel'] ?? null,
                'bill_labor' => $validated['bill_labor'] ?? null,
                'bill_fuel' => $validated['bill_fuel'] ?? null,
                'bill_address' => $validated['bill_address'] ?? null,
                'bill_account' => $validated['bill_account'] ?? null,
                'bill_po' => $validated['bill_po'] ?? null,
                'bill_city' => $validated['bill_city'] ?? null,
                'bill_state' => $validated['bill_state'] ?? null,
                'bill_zip' => $validated['bill_zip'] ?? null,
                'bill_phone' => $validated['bill_phone'] ?? null,
            ]);

            $contact = $billTo->emails()->first();

            if (!empty($validated['contact_email'])) {
                $contactData = [
                    'bill_email' => $validated['contact_email'],
                    'bill_name' => $validated['contact_name'] ?? null,
                    'bill_active' => (bool) ($validated['contact_active'] ?? false),
                ];

                if ($contact) {
                    $contact->update($contactData);
                } else {
                    $billTo->emails()->create($contactData);
                }
            } elseif ($contact) {
                // Keep the existing contact if the email field is left blank.
            }
        });

        return redirect()->route('bill-to.show', $billTo)
            ->with('success', 'Billing account updated successfully.');
    }

    public function destroy(BillTo $billTo): RedirectResponse
    {
        if ($billTo->sites()->exists()) {
            return back()->with('error', 'This billing account cannot be deleted because it is assigned to one or more Sites.');
        }

        DB::transaction(function () use ($billTo) {
            $billTo->emails()->delete();
            $billTo->delete();
        });

        return redirect()->route('bill-to.index')
            ->with('success', 'Billing account deleted successfully.');
    }
}
