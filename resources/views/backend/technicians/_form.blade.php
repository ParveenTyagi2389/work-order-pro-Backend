<div class="row g-4">
    <div class="col-12">
        <div class="panel">
            <h6 class="font-weight-bold mb-3">Technician details</h6>
            <div class="mb-3">
                <label class="form-label form-label-custom">Technician name <span class="text-danger">*</span></label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant" type="text" name="name" maxlength="255" value="{{ old('name', $technician->name ?? '') }}" required>
                @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Access level <span class="text-danger">*</span></label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant" type="number" name="access" min="0" value="{{ old('access', $technician->access ?? 1) }}" required>
                @error('access')<div class="text-danger small">{{ $message }}</div>@enderror
                <small class="text-muted">Stores the numeric access value from your technicians table.</small>
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Phone</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant" type="text" name="phone" maxlength="20" value="{{ old('phone', $technician->phone ?? '') }}">
                @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Email</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant" type="email" name="email" maxlength="255" value="{{ old('email', $technician->email ?? '') }}">
                @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Notes</label>
                <textarea class="form-control form-control-styled textarea-styled-desc col-md-textarea" name="notes" rows="4">{{ old('notes', $technician->notes ?? '') }}</textarea>
                @error('notes')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="form-check mb-3">
                <input type="hidden" name="active" value="0">
                <input class="form-check-input" type="checkbox" id="active" name="active" value="1" @checked(old('active', $technician->active ?? true))>
                <label class="form-check-label form-label-custom" for="active">Active technician</label>
                @error('active')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('technicians.index') }}" class="btn-back-custom   ">Cancel</a>
    <button class="btn btn-success text-white font-weight-bold btn-primary-custom" type="submit">{{ isset($technician) ? 'Update Technician' : 'Save Technician' }}</button>
</div>
