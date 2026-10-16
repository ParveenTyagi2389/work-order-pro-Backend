<div class="row g-4">
    <div class="col-md-7">
        <div class="panel">
            <h6 class="font-weight-bold mb-3">
                Shapes details
            </h6>
            <div class="mb-3">
                <label class="form-label form-label-custom">Shape name <span class="text-danger">*</span></label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant" name="shape_name" value="{{ old('shape_name', $shape->shape_name ?? '') }}" maxlength="255" required>
                @error('shape_name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Shape code <span class="text-danger">*</span></label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant" name="shape_code" value="{{ old('shape_code', $shape->shape_code ?? '') }}" maxlength="255" required>
                @error('shape_code')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('shapes.index') }}" class="btn bg-white font-weight-bold w-fixed-sm">Cancel</a>
    <button class="btn btn-success font-weight-bold text-white w-fixed-sm" type="submit">
        {{ isset($shape) ? 'Update' : 'Save' }}
    </button>
</div>
