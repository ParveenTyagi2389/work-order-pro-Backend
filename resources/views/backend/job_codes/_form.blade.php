<div class="row g-4">
    <div class="col-md-7">
        <div class="panel">
            <h6 class="font-weight-bold mb-3">
                Job Codes details
            </h6>
            <div class="mb-3">
                <label class="form-label form-label-custom">
                    Job code name 
                    <span class="text-danger">*</span>
                </label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant" name="foldername" value="{{ old('foldername', $jobCode->foldername ?? '') }}" maxlength="255" >
                @error('foldername')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">
                    Color *
                </label>
                <select name="foldercolor" class="form-control form-control-styled form-input-padded layout-input-variant" >
                    <option value="">Select color</option>
                    @foreach($colors as $option)
                        <option value="{{ $option->color_name }}" @selected(old('foldercolor',$jobCode->foldercolor ?? '') === $option->color_name)>
                            {{ $option->color_name }} ({{ $option->color_code }})
                        </option>
                    @endforeach
                </select>
                @error('foldercolor')
                    <div class="text-danger small">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">
                    Shape *
                </label>
                <select name="foldershape" class="form-control form-control-styled form-input-padded layout-input-variant" required>
                    <option value="">Select shape</option>
                    @foreach($shapes as $option)
                        <option value="{{ $option->shape_name }}" @selected(old('foldershape',$jobCode->foldershape ?? '') === $option->shape_name)>
                            {{ $option->shape_name }} @if($option->shape_code)({{ $option->shape_code }})@endif
                        </option>
                    @endforeach
                </select>
                @error('foldershape')
                    <div class="text-danger small">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('job-codes.index') }}" class="btn-back-custom">Cancel</a>
    <button class="btn-primary-custom" type="submit">
        {{ isset($jobCode) ? 'Update' : 'Save' }}
    </button>
</div>
