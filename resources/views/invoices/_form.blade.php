@php
    $editing = $invoice !== null;
    $rows = old('items', $editing ? $invoice->items->map(fn($x) => [
        'description'=>$x->description, 'job_code'=>$x->job_code,
        'quantity'=>$x->quantity, 'unit_price'=>$x->unit_price
    ])->toArray() : [['description'=>'','job_code'=>'','quantity'=>1,'unit_price'=>0]]);
    $recipient = old('recipient_email', $defaultEmail ?? '');
    $emailMessage = old('email_message', $invoice->email_message ?? "Hi,\n\nPlease find your invoice attached.\nPayment is due by the due date shown on the invoice.\n\nThank you for your business.");
@endphp

@if($errors->any())
<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif
<div class="invoice-editor-grid">
    <section class="invoice-paper">
        <div class="invoice-banner"><div><h2>INVOICE</h2><span>#{{ $invoice->invoice_number ?? 'Generated when saved' }}</span></div></div>
        <form method="POST" action="{{ $action }}" id="invoiceForm">
            @csrf
            @if($method !== 'POST') @method($method) @endif
            <div class="invoice-body">
                <div class="invoice-parties">
                    <div class="party-block">
                        <h4>FROM</h4>
                        <strong>{{ config('app.name', 'FieldOps Services LLC') }}</strong>
                        <p>2200 Mission Street<br>San Francisco, CA 94110<br>{{ config('mail.from.address') }}</p>
                    </div>
                    <div class="party-block">
                        <h4>BILL TO *</h4>
                        <select name="bill_to_id" required class="form-control form-control-styled form-input-padded layout-input-variant">
                            <option value="">Select customer</option>
                            @foreach($billTos as $b)
                            <option value="{{ $b->id }}" @selected(old('bill_to_id',$invoice->bill_to_id ?? '') == $b->id)>{{ $b->bill_name }}</option>
                            @endforeach
                        </select>
                        <input type="email" name="recipient_email" value="{{ $recipient }}" placeholder="Customer email" class="form-control form-control-styled form-input-padded layout-input-variant mt-2">
                        <textarea name="billing_address" rows="2" class="form-control form-control-styled form-input-padded layout-input-variant mt-2" placeholder="Billing address (display only)">{{ old('billing_address', '') }}</textarea>
                    </div>
                    <div class="party-block">
                        <h4>DETAILS</h4>
                        <label>Invoice Date</label>
                        <input type="date" name="invoice_date" required value="{{ old('invoice_date',$invoice?->invoice_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" class="form-control form-control-styled form-input-padded layout-input-variant">
                        <label class="mt-2">Due Date</label>
                        <input type="date" name="due_date" value="{{ old('due_date',$invoice?->due_date?->format('Y-m-d') ?? now()->addDays(14)->format('Y-m-d')) }}" class="form-control form-control-styled form-input-padded layout-input-variant">
                        <label class="mt-2">Work Order (optional)</label>
                        <select name="work_order_id" class="form-control form-control-styled form-input-padded layout-input-variant">
                            <option value="">None</option>
                            @foreach($workOrders as $w)
                            <option value="{{ $w->id }}" @selected(old('work_order_id',$invoice->work_order_id ?? '') == $w->id)>WO-{{ $w->id }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="status" value="{{ old('status',$invoice->status ?? 'draft') }}">
                    </div>
                </div>
                <div class="line-items-heading">
                    <span>DESCRIPTION</span>
                    {{-- <span>JOB CODE</span> --}}
                    <span>QTY</span>
                    <span>UNIT PRICE</span>
                    <span>TOTAL</span>
                    <span></span>
                </div>
                <div id="invoiceItems">
                    @foreach($rows as $i => $item)
                    <div class="line-item-row">
                        <input name="items[{{ $i }}][description]" value="{{ $item['description'] ?? '' }}" required maxlength="255" placeholder="Description" class="form-control form-control-styled form-input-padded layout-input-variant">
                        {{-- <input name="items[{{ $i }}][job_code]" value="{{ $item['job_code'] ?? '' }}" placeholder="Code" class="form-control form-control-styled form-input-padded layout-input-variant"> --}}
                        <input type="number" name="items[{{ $i }}][quantity]" value="{{ $item['quantity'] ?? 1 }}" min="0.01" step="0.01" required class="form-control form-control-styled form-input-padded layout-input-variant qty-input">
                        <input type="number" name="items[{{ $i }}][unit_price]" value="{{ $item['unit_price'] ?? 0 }}" min="0" step="0.01" required class="form-control form-control-styled form-input-padded layout-input-variant price-input">
                        <strong class="line-total">$0.00</strong>
                        <button type="button" class="remove-item" aria-label="Remove item">×</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="add-line-item" id="addInvoiceItem">+ Add Line Item</button>
                <div class="invoice-bottom">
                    <div class="notes-area">
                        <label>Notes to Customer</label>
                        <textarea name="notes" rows="4" class="form-control form-control-styled form-input-padded layout-input-variant" placeholder="Thank you for your business...">{{ old('notes',$invoice->notes ?? '') }}</textarea>
                        {{-- <div class="payment-terms"><strong>Payment Terms:</strong> Net 14 days · Bank transfer or credit card accepted</div> --}}
                    </div>
                    <div class="totals-area">
                        <div><span>Subtotal</span><strong id="subtotalDisplay">$0.00</strong></div>
                        <div><label for="taxRate">Tax Rate</label><input id="taxRate" type="number" name="tax_rate" min="0" max="100" step="0.001" value="{{ old('tax_rate',$invoice->tax_rate ?? 8.5) }}" required class="form-control form-control-styled"></div>
                        <div><span>Tax Amount</span><strong id="taxDisplay">$0.00</strong></div>
                        <div><label for="discount">Discount</label><input id="discount" type="number" name="discount" min="0" step="0.01" value="{{ old('discount',$invoice->discount ?? 0) }}" class="form-control form-control-styled"></div>
                        <hr>
                        <div class="grand-total"><strong>Total</strong><strong id="totalDisplay">$0.00</strong></div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <aside class="invoice-sidebar">
        <section class="settings-card">
            <h3>Invoice Settings</h3>
            <label>Send To</label>
            <input form="invoiceForm" type="email" name="recipient_email" value="{{ $recipient }}" placeholder="customer@example.com" class="form-control form-control-styled form-input-padded layout-input-variant" id="recipientEmailSide">
            <label>CC (optional)</label>
            <input form="invoiceForm" type="email" name="cc_email" value="{{ old('cc_email',$invoice->cc_email ?? '') }}" placeholder="cc@example.com" class="form-control form-control-styled form-input-padded layout-input-variant">
            <label>Email Subject</label>
            <input form="invoiceForm" type="text" name="email_subject" value="{{ old('email_subject','Invoice '.($invoice->invoice_number ?? 'from '.config('app.name','WorkOrder Pro')) ) }}" class="form-control form-control-styled form-input-padded layout-input-variant">
            <label>Message</label>
            <textarea form="invoiceForm" name="email_message" rows="4" class="form-control form-control-styled form-input-padded layout-input-variant">{{ $emailMessage }}</textarea>
            <label class="check-row"><input form="invoiceForm" type="checkbox" name="attach_pdf" value="1" @checked(old('attach_pdf',$invoice->attach_pdf ?? true))> Attach PDF copy</label>
            <label class="check-row"><input form="invoiceForm" type="checkbox" name="send_reminder" value="1" @checked(old('send_reminder',$invoice->send_reminder ?? false))> Send payment reminder (3 days before due)</label>
            <button form="invoiceForm" type="submit" name="submit_action" value="send" class="send-button">📩 {{ $editing ? 'Send Invoice' : 'Send Invoice' }}</button>
            <button form="invoiceForm" type="submit" name="submit_action" value="draft" class="draft-button">Save as Draft</button>
            <p class="small-note">Email is sent using the mail server configured in your Laravel .env file.</p>
        </section>
        {{-- <section class="settings-card payment-methods">
            <h3>Payment Methods</h3>
            <div><span>🏦 Bank Transfer (ACH)</span><b>Enabled</b></div>
            <div><span>💳 Credit / Debit Card</span><b>Enabled</b></div>
            <div><span>🔗 Online Pay Link</span><i>Off</i></div>
            <p class="small-note">Display only. No payment gateway is connected by this module.</p>
        </section> --}}
    </aside>
</div>

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('invoiceItems');
    const addButton = document.getElementById('addInvoiceItem');
    const taxInput = document.getElementById('taxRate');
    const discountInput = document.getElementById('discount');
    let nextIndex = 0;

    function money(value) {
        return new Intl.NumberFormat('en-US', {style:'currency', currency:'USD'}).format(value || 0);
    }
    function recalculate() {
        let subtotal = 0;
        container.querySelectorAll('.line-item-row').forEach(row => {
            const qty = parseFloat(row.querySelector('.qty-input')?.value || 0);
            const price = parseFloat(row.querySelector('.price-input')?.value || 0);
            const line = Math.round(qty * price * 100) / 100;
            subtotal += line;
            row.querySelector('.line-total').textContent = money(line);
        });
        const discount = Math.min(Math.max(0, parseFloat(discountInput.value || 0)), subtotal);
        const taxable = Math.max(0, subtotal - discount);
        const tax = Math.round(taxable * (Math.max(0, parseFloat(taxInput.value || 0) / 100)) * 100) / 100;
        document.getElementById('subtotalDisplay').textContent = money(subtotal);
        document.getElementById('taxDisplay').textContent = money(tax);
        document.getElementById('totalDisplay').textContent = money(taxable + tax);
    }
    container.querySelectorAll('.line-item-row input[name]').forEach(input => {
        const match = input.name.match(/^items\[(\d+)\]/);
        if (match) nextIndex = Math.max(nextIndex, Number(match[1]) + 1);
    });
    container.addEventListener('input', recalculate);
    taxInput.addEventListener('input', recalculate);
    discountInput.addEventListener('input', recalculate);

    addButton.addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'line-item-row';
        row.innerHTML = `
            <input name="items[${nextIndex}][description]" required maxlength="255" placeholder="Description" class="form-control form-control-styled form-input-padded layout-input-variant">
                
            <input type="number" name="items[${nextIndex}][quantity]" value="1" min="0.01" step="0.01" required class="form-control form-control-styled form-input-padded layout-input-variant qty-input">
            <input type="number" name="items[${nextIndex}][unit_price]" value="0" min="0" step="0.01" required class="form-control form-control-styled form-input-padded layout-input-variant price-input">
            <strong class="line-total">$0.00</strong>
            <button type="button" class="remove-item" aria-label="Remove item">×</button>`;
        container.appendChild(row);
        nextIndex++;
        recalculate();
    });

    container.addEventListener('click', function (event) {
        if (event.target.closest('.remove-item')) {
            const rows = container.querySelectorAll('.line-item-row');
            if (rows.length > 1) {
                event.target.closest('.line-item-row').remove();
                recalculate();
            } else {
                alert('An invoice must have at least one line item.');
            }
        }
    });

    // Keep the email recipient in both locations synchronized.
    const billToSelect = document.querySelector('[name="bill_to_id"]');
    const recipientSide = document.getElementById('recipientEmailSide');
    const recipientMain = document.querySelector('.party-block input[name="recipient_email"]');
    if (recipientSide && recipientMain) {
        recipientSide.addEventListener('input', () => recipientMain.value = recipientSide.value);
        recipientMain.addEventListener('input', () => recipientSide.value = recipientMain.value);
    }
    recalculate();
});
</script>
@endsection
