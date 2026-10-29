<div class="row g-4"><div class="col-12"><div class="panel">
<h6 class="font-weight-bold mb-3">Job Flat Rates details</h6>
<div class="mb-3">
<label class="form-label form-label-custom">Work order <span class="text-danger">*</span></label>
<select name="work_order_id" class="form-control form-control-styled form-input-padded layout-input-variant" required><option value="">Select work order</option>@foreach($workOrders as $wo)<option value="{{ $wo->id }}" @selected((string)old('work_order_id', $jobFlatRate->work_order_id ?? '') === (string)$wo->id)>{{ $wo->customer_work_order ?: ('WO-'.$wo->id) }}</option>@endforeach</select>
@error('work_order_id')<div class="text-danger small">{{ $message }}</div>@enderror</div>
<div class="mb-3">
<label class="form-label form-label-custom">Rate <span class="text-danger">*</span></label>
<input type="number" step="0.01" min="0" name="rate" class="form-control form-control-styled form-input-padded layout-input-variant" value="{{ old('rate', $jobFlatRate->rate ?? '') }}" required>
@error('rate')<div class="text-danger small">{{ $message }}</div>@enderror</div>
<div class="mb-3">
<label class="form-label form-label-custom">Description</label>
<textarea name="description" rows="4" class="form-control form-control-styled textarea-styled-desc">{{ old('description', $jobFlatRate->description ?? '') }}</textarea>
@error('description')<div class="text-danger small">{{ $message }}</div>@enderror</div>
</div></div></div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5"><a href="{{ route('job-flat-rates.index') }}" class="btn-back-custom">Cancel</a><button type="submit" class="btn-primary-custom">{{ isset($jobFlatRate) ? 'Update' : 'Save' }} Job Flat Rates</button></div>