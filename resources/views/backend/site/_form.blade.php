@csrf

@if (isset($site))
    @method('PUT')
@endif

<div class="row g-4">
    {{-- Left column --}}
    <div class="col-md-7">
        <div class="panel mb-4">
            <h6 class="font-weight-bold mb-3">Site identity</h6>

            <div class="mb-3">
                <label class="form-label form-label-custom">Site name <span class="text-danger">*</span></label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="name"
                       value="{{ old('name', $site->name ?? '') }}" required />
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">External site ID</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="site_id"
                       value="{{ old('site_id', $site->site_id ?? '') }}" />
                @error('site_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">Street address</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="address"
                       value="{{ old('address', $site->address ?? '') }}" />
            </div>

            <div class="row g-3">
                <div class="col-sm-4">
                    <label class="form-label form-label-custom">City</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="text" name="city"
                           value="{{ old('city', $site->city ?? '') }}" />
                </div>
                <div class="col-sm-4">
                    <label class="form-label form-label-custom">State</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="text" name="state" maxlength="100"
                           value="{{ old('state', $site->state ?? '') }}" />
                </div>
                <div class="col-sm-4">
                    <label class="form-label form-label-custom">ZIP</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="text" name="zip"
                           value="{{ old('zip', $site->zip ?? '') }}" />
                </div>
            </div>
        </div>

        <div class="panel">
            <h6 class="font-weight-bold mb-3">Site contact</h6>

            <div class="mb-3">
                <label class="form-label form-label-custom">Contact name</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="contact_name"
                       value="{{ old('contact_name', $site->contact_name ?? '') }}" />
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">Customer type <span class="text-danger">*</span></label>
                <select class="form-control form-control-styled form-input-padded layout-input-variant"
                        name="cust_type_id" required>
                    <option value="">— Select —</option>
                    @foreach ($customerTypes as $type)
                        <option value="{{ $type->customer_type_id }}"
                            @selected(old('cust_type_id', $site->cust_type_id ?? '') == $type->customer_type_id)>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('cust_type_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">Bill to <span class="text-danger">*</span></label>
                <select class="form-control form-control-styled form-input-padded layout-input-variant"
                        name="bill_to_id" required>
                    <option value="">— Select —</option>
                    @foreach ($billTos as $bt)
                        <option value="{{ $bt->id }}"
                            @selected(old('bill_to_id', $site->bill_to_id ?? '') == $bt->id)>
                            {{ $bt->name }}
                        </option>
                    @endforeach
                </select>
                @error('bill_to_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="form-label form-label-custom">Arrival instructions / Notes</label>
                <textarea class="form-control form-control-styled textarea-styled-desc col-md-textarea"
                          rows="4" name="notes">{{ old('notes', $site->notes ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Right column --}}
    <div class="col-md-5">
        <div class="panel mb-4">
            <h6 class="font-weight-bold mb-3">Map &amp; service access</h6>

            <div class="map-placeholder map-placeholder-bg">
                <div class="floating-map-badge">
                    {{ $site->name ?? 'New site' }} · GPS
                    {{ $site->latitude ?? '—' }}, {{ $site->longitude ?? '—' }}
                </div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6">
                    <label class="form-label form-label-custom">Latitude</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="number" step="0.0000001" name="latitude"
                           value="{{ old('latitude', $site->latitude ?? '') }}" />
                    @error('latitude') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                <div class="col-6">
                    <label class="form-label form-label-custom">Longitude</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="number" step="0.0000001" name="longitude"
                           value="{{ old('longitude', $site->longitude ?? '') }}" />
                    @error('longitude') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="map-info-box mt-3">
                <i class="fi-rs-marker text-blue-main"></i>
                <span class="map-info-text">Coordinates are used for technician check-in validation.</span>
            </div>
        </div>

        <div class="panel">
            <h6 class="font-weight-bold mb-3">Status</h6>

            <div class="site-status-container-centered">
                <label class="site-status-pill @if(!old('is_active', $site->is_active ?? true)) site-status-active @endif">
                    <input type="radio" name="is_active" value="0"
                           @checked(!old('is_active', $site->is_active ?? true))>
                    Inactive
                </label>
                <label class="site-status-pill @if(old('is_active', $site->is_active ?? true)) site-status-active @endif">
                    <input type="radio" name="is_active" value="1"
                           @checked(old('is_active', $site->is_active ?? true))>
                    Active
                </label>
            </div>

            <h6 class="font-weight-bold mb-3 text-sm mt-3">Scheduling preferences</h6>

            <div class="mb-4">
                <label class="form-label form-label-custom">Default service window</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="hours"
                       value="{{ old('hours', $site->hours ?? '') }}"
                       placeholder="Mon-Fri · 8:00 AM - 5:00 PM" />
            </div>

            <div class="display-flex align-items-center gap-2 mb-3">
                <input type="hidden" name="require_contact_before_arrival" value="0">
                <input type="checkbox" class="form-checkbox"
                       name="require_contact_before_arrival" value="1"
                       @checked(old('require_contact_before_arrival', $site->require_contact_before_arrival ?? false))>
                <span class="site-checkbox-label">Require customer contact before arrival</span>
            </div>
            <div class="display-flex align-items-center gap-2">
                <input type="hidden" name="show_on_map" value="0">
                <input type="checkbox" class="form-checkbox"
                       name="show_on_map" value="1"
                       @checked(old('show_on_map', $site->show_on_map ?? true))>
                <span class="site-checkbox-label">Show site on technician map</span>
            </div>

            <div class="mt-4">
                <label class="form-label form-label-custom">CVS link</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="url" name="cvs_link"
                       value="{{ old('cvs_link', $site->cvs_link ?? '') }}" />
                @error('cvs_link') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
</div>

<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('sites.index') }}" class="btn bg-white font-weight-bold w-fixed-sm">Back</a>
    <button class="btn btn-success font-weight-bold text-white w-fixed-sm" type="submit">
        Save
    </button>
</div>