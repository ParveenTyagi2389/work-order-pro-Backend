<div class="row g-4">
    <div class="col-12">
        <div class="panel">
            <h6 class="font-weight-bold mb-3">Job Picture details</h6>
            <div class="mb-3">
                <label class="form-label form-label-custom">Work order *</label>
                <select name="work_order_id" class="form-control form-control-styled form-input-padded layout-input-variant" required>
                    <option value="">Select work order</option>
                    @foreach($workOrders as $wo)
                        <option value="{{ $wo->id }}" @selected((string)old('work_order_id',$jobPicture->work_order_id ?? '') === (string)$wo->id)>
                            {{ $wo->customer_work_order ?: ('WO-'.$wo->id) }}
                        </option>
                    @endforeach
                </select>
                @error('work_order_id')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Description</label>
                <textarea name="description" rows="3" class="form-control form-control-styled textarea-styled-desc">{{ old('description',$jobPicture->description ?? '') }}</textarea>
                @error('description')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Picture @if(!isset($jobPicture))*@endif</label>
                <input type="file" name="picture" accept="image/jpeg,image/png,image/webp,image/gif" class="form-control form-control-styled form-input-padded layout-input-variant" @required(!isset($jobPicture))>
                <small class="text-muted">JPG, PNG, WEBP or GIF; maximum 5 MB.</small>
                @error('picture')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
                @if(isset($jobPicture) && $jobPicture->picture)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$jobPicture->picture) }}" alt="Current job picture" style="max-width:180px;max-height:140px;object-fit:contain">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('job-pictures.index') }}" class="btn-back-custom">Cancel</a>
    <button type="submit" class="btn-custom btn-primary-custom">
        {{ isset($jobPicture) ? 'Update Job Picture' : 'Save' }}
    </button>
</div>
