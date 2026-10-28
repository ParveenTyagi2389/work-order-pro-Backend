<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Invoice $invoice,
        public string $messageText
    ) {}

    public function build()
    {
        $mail = $this->subject('Invoice ' . $this->invoice->invoice_number)
            ->view('emails.invoice');

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class) && $this->invoice->attach_pdf) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.pdf', [
                'invoice' => $this->invoice,
                'company' => config('app.name', 'WorkOrder Pro'),
            ])->output();

            $mail->attachData($pdf, $this->invoice->invoice_number . '.pdf', [
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }
}
