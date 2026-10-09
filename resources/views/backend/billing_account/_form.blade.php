<div class="panel border role-panel mb-4">
    <h4 class="font-weight-bold text-success text-uppercase mb-4">CUSTOMER INFORMATION</h4>

    <h5 class="font-weight-bold mb-3 mt-4">Company profile</h5>

    <div class="row g-4 mb-3">
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">
                Legal business name <span class="text-danger">*</span>
            </label>
            <input class="form-control-styled form-control" type="text"
                   name="bill_name" value="{{ old('bill_name', $billTo->bill_name ?? '') }}" required />
            @error('bill_name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">Account number</label>
            <input class="form-control-styled form-control" type="text"
                   name="bill_account" value="{{ old('bill_account', $billTo->bill_account ?? '') }}" />
            @error('bill_account')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="row g-4 mb-3">
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">Purchase order</label>
            <input class="form-control-styled form-control" type="text"
                   name="bill_po" value="{{ old('bill_po', $billTo->bill_po ?? '') }}" />
            @error('bill_po')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">Phone</label>
            <input class="form-control-styled form-control" type="text"
                   name="bill_phone" value="{{ old('bill_phone', $billTo->bill_phone ?? '') }}" />
            @error('bill_phone')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
    </div>

    <h5 class="font-weight-bold mb-3 mt-4">Billing address</h5>
    <div class="mb-3">
        <label class="form-label-custom font-weight-bold">Address</label>
        <textarea class="form-control-styled form-control" name="bill_address">{{ old('bill_address', $billTo->bill_address ?? '') }}</textarea>
        @error('bill_address')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    <div class="row g-4 mb-3">
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">City</label>
            <input class="form-control-styled form-control" type="text"
                   name="bill_city" value="{{ old('bill_city', $billTo->bill_city ?? '') }}" />
            @error('bill_city')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">State</label>
            <input class="form-control-styled form-control" type="text"
                   name="bill_state" value="{{ old('bill_state', $billTo->bill_state ?? '') }}" />
            @error('bill_state')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="row g-4 mb-3">
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">ZIP</label>
            <input class="form-control-styled form-control" type="text"
                   name="bill_zip" value="{{ old('bill_zip', $billTo->bill_zip ?? '') }}" />
            @error('bill_zip')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
    </div>

    <h5 class="font-weight-bold mb-3 mt-4">Billing profile</h5>
    <div class="row g-4 mb-3">
        <div class="column-full col-md-4">
            <label class="form-label-custom font-weight-bold">Travel charge</label>
            <input class="form-control-styled form-control" type="number" min="0" step="0.01"
                   name="bill_travel" value="{{ old('bill_travel', $billTo->bill_travel ?? '') }}" />
            @error('bill_travel')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="column-full col-md-4">
            <label class="form-label-custom font-weight-bold">Labor charge</label>
            <input class="form-control-styled form-control" type="number" min="0" step="0.01"
                   name="bill_labor" value="{{ old('bill_labor', $billTo->bill_labor ?? '') }}" />
            @error('bill_labor')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="column-full col-md-4">
            <label class="form-label-custom font-weight-bold">Fuel charge</label>
            <input class="form-control-styled form-control" type="number" min="0" step="0.01"
                   name="bill_fuel" value="{{ old('bill_fuel', $billTo->bill_fuel ?? '') }}" />
            @error('bill_fuel')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
    </div>

    <h5 class="font-weight-bold mb-3 mt-4">Primary billing contact</h5>
    <div class="mb-3">
        <label class="form-label-custom font-weight-bold">Contact name</label>
        <input class="form-control-styled form-control" type="text" name="contact_name"
               value="{{ old('contact_name', $primaryEmail->bill_name ?? '') }}" />
        @error('contact_name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
    </div>

    <div class="row g-4 mb-3">
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">Email</label>
            <input class="form-control-styled form-control" type="email" name="contact_email"
                   value="{{ old('contact_email', $primaryEmail->bill_email ?? '') }}" />
            @error('contact_email')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="column-full col-md-6">
            <label class="form-label-custom font-weight-bold">Active</label>
            <div class="display-flex align-items-center gap-2 mb-2">
                <input class="form-checkbox" type="checkbox" name="contact_active" value="1"
                       {{ old('contact_active', $primaryEmail->bill_active ?? true) ? 'checked' : '' }} />
                <span class="permission-text">Active billing contact</span>
            </div>
            @error('contact_active')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
