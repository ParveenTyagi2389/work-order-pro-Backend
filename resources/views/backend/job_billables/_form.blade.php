<div class="row g-4">
    <div class="col-12">
        <div class="panel">
            <h6 class="font-weight-bold mb-3">
                Job Billing details
            </h6>
            <div class="mb-3">
            <label class="form-label form-label-custom">
                Work order
                <span class="text-danger">*</span>
            </label>
            <select name="work_order_id" class="form-control form-control-styled form-input-padded layout-input-variant" required>
                <option value="">Select work order</option>
                @foreach($workOrders as $wo)
                <option value="{{ $wo->id }}" @selected((string)old('work_order_id', $jobBillable->work_order_id ?? '') === (string)$wo->id)>{{ $wo->customer_work_order ?: ('WO-'.$wo->id) }}</option>
                @endforeach
            </select>
            @error('work_order_id')
            <div class="text-danger small">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label form-label-custom">Check-in</label>
                <input type="datetime-local" name="check_in" class="form-control form-control-styled form-input-padded layout-input-variant" value="{{ old('check_in', isset($jobBillable) && $jobBillable->check_in ? $jobBillable->check_in->format('Y-m-d\\TH:i') : '') }}">
                @error('check_in')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Check-out</label>
                <input type="datetime-local" name="check_out" class="form-control form-control-styled form-input-padded layout-input-variant" value="{{ old('check_out', isset($jobBillable) && $jobBillable->check_out ? $jobBillable->check_out->format('Y-m-d\\TH:i') : '') }}">
                @error('check_out')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Description</label>
                <textarea name="description" rows="4" class="form-control form-control-styled textarea-styled-desc">{{ old('description', $jobBillable->description ?? '') }}</textarea>
                @error('description')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('job-billables.index') }}" class="btn-back-custom">Cancel</a>
    <button type="submit" class="btn btn-success text-white font-weight-bold btn-primary-custom">
        {{ isset($jobBillable) ? 'Update' : 'Save' }} Job Billing
    </button>
</div>