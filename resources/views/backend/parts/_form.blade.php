<div class="row g-4">
    <div class="col-md-7">
        <div class="panel">
            <h6 class="font-weight-bold mb-3">Part details</h6>

            <div class="mb-3">
                <label class="form-label form-label-custom">Part number <span class="text-danger">*</span></label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="part_number" maxlength="255"
                       value="{{ old('part_number', $part->part_number ?? '') }}" required>
                @error('part_number') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">Description</label>
                <textarea class="form-control form-control-styled textarea-styled-desc col-md-textarea"
                          name="description" rows="4">{{ old('description', $part->description ?? '') }}</textarea>
                @error('description') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
</div>

<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('parts.index') }}" class="btn bg-white font-weight-bold w-fixed-sm">Cancel</a>
    <button class="btn btn-success font-weight-bold text-white w-fixed-sm" type="submit">
        {{ isset($part) ? 'Update Part' : 'Save Part' }}
    </button>
</div>
