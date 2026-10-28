<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class InvoicePdfController extends Controller
{
    public function show(Invoice $invoice)
    {
        if (!class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            return back()->withErrors(['pdf' => 'PDF support is not installed. Run: composer require barryvdh/laravel-dompdf']);
        }

        $invoice->load(['billTo','items','workOrder']);
        return \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.pdf', [
            'invoice' => $invoice,
            'company' => config('app.name', 'WorkOrder Pro'),
        ])->download($invoice->invoice_number . '.pdf');
    }
}
