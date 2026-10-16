<div class="row g-4">
    <div class="col-lg-7">
        <div class="panel mb-4">
            <h6 class="font-weight-bold mb-3">
                Work order details
            </h6>
            <div class="mb-3">
                <label class="form-label form-label-custom">
                    Site
                     <span class="text-danger">*</span>
                </label>
                <select name="site_id" class="form-control form-control-styled form-input-padded layout-input-variant" required>
                    <option value="">Select site</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}" @selected((string)old('site_id',$workOrder->site_id ?? '') === (string)$site->id)>{{ $site->name }}</option>
                    @endforeach
                </select>
                @error('site_id')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Solution / work performed</label>
                <textarea name="solution" rows="4" class="form-control form-control-styled textarea-styled-desc">{{ old('solution',$workOrder->solution ?? '') }}</textarea>
                @error('solution')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="panel mb-4">
            <h6 class="font-weight-bold mb-3">Charges & status</h6>
            <div class="mb-3">
                <label class="form-label form-label-custom">Override travel</label>
                <input type="number" step="0.01" min="0" name="override_travel" class="form-control form-control-styled form-input-padded layout-input-variant" value="{{ old('override_travel',$workOrder->override_travel ?? '') }}">
                @error('override_travel')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Override labor</label>
                <input type="number" step="0.01" min="0" name="override_labor" class="form-control form-control-styled form-input-padded layout-input-variant" value="{{ old('override_labor',$workOrder->override_labor ?? '') }}">
                @error('override_labor')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            @foreach(['fuel_reimbursement'=>'Fuel reimbursement','serviced'=>'Work completed / serviced','billed'=>'Billed'] as $key=>$label)
            <div class="form-check mb-3">
                <input type="hidden" name="{{ $key }}" value="0">
                <input class="form-check-input" type="checkbox" name="{{ $key }}" value="1" id="{{ $key }}" @checked(old($key,$workOrder->$key ?? false))>
                <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('work-orders.index') }}" class="btn-back-custom">Cancel</a>
    <button type="submit" class="btn-primary-custom">
        {{ isset($workOrder) ? 'Update Work Order' : 'Save Work Order' }}
    </button>
</div>
