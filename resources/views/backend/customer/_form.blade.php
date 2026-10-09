@csrf
<div class="panel border role-panel mb-4">
    <h4 class="font-weight-bold text-success text-uppercase mb-4">CUSTOMER TYPE INFORMATION</h4>
    <h5 class="font-weight-bold mb-3 mt-4">Customer type</h5>
    <div class="mb-3">
        <label class="form-label-custom font-weight-bold" for="name">
            Customer type name <span class="text-danger">*</span>
        </label>
        <input id="name"
               name="name"
               class="form-control-styled form-control @error('name') is-invalid @enderror"
               type="text"
               value="{{ old('name', $customerType->name ?? '') }}"
               maxlength="255"
               required
               autofocus />
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
