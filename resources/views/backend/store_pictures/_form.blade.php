<div class="row g-4">
    <div class="col-12">
        <div class="panel">
            <h6 class="font-weight-bold mb-3">
                Store / Site Picture details
            </h6>
            <div class="mb-3">
                <label class="form-label form-label-custom">
                    Site *
                </label>
                <select name="site_id" class="form-control form-control-styled form-input-padded layout-input-variant" required>
                    <option value="">Select site</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}" @selected((string)old('site_id',$storePicture->site_id ?? '') === (string)$site->id)>
                            {{ $site->name }}
                        </option>
                    @endforeach
                </select>
                @error('site_id')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Description</label>
                <textarea name="description" rows="3" class="form-control form-control-styled textarea-styled-desc">{{ old('description',$storePicture->description ?? '') }}</textarea>
                @error('description')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Notes</label>
                <textarea name="notes" rows="3" class="form-control form-control-styled textarea-styled-desc">{{ old('notes',$storePicture->notes ?? '') }}</textarea>
                @error('notes')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Picture @if(!isset($storePicture))*@endif</label>
                <input type="file" name="picture" accept="image/jpeg,image/png,image/webp,image/gif" class="form-control form-control-styled form-input-padded layout-input-variant" @required(!isset($storePicture))>
                <p class="text-muted jpg-text">JPG, PNG, WEBP or GIF; maximum 5 MB.</p>
                @error('picture')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
                @if(isset($storePicture) && $storePicture->picture)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$storePicture->picture) }}" alt="Current site picture" style="max-width:180px;max-height:140px;object-fit:contain">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('store-pictures.index') }}" class="btn-back-custom">Cancel</a>
    <button type="submit" class="btn-custom btn-primary-custom">
        {{ isset($storePicture) ? 'Update Store / Site Picture' : 'Save Store' }}
    </button>
</div>
