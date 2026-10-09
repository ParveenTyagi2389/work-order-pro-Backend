@php
    $selectedCustomerType = old('customer_type', $site->customer_type ?? '');
    $selectedBillTo = old('bill_to', $site->bill_to ?? '');
@endphp

<div class="row g-4">
    <div class="col-md-7">
        <div class="panel mb-4">
            <h6 class="font-weight-bold mb-3">Site identity</h6>

            <div class="mb-3">
                <label class="form-label form-label-custom">Site name <span class="text-danger">*</span></label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="name" value="{{ old('name', $site->name ?? '') }}" required />
                @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">External site ID</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="site_id" value="{{ old('site_id', $site->site_id ?? '') }}" />
                @error('site_id')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">Street address</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" id="site-address" name="address" autocomplete="off"
                       value="{{ old('address', $site->address ?? '') }}"
                       placeholder="Start typing an address..." />
                <div id="address-suggestions" class="list-group mt-1" style="display:none; position:relative; z-index:20;"></div>
                <small class="text-muted">Start typing and select an address to fill city, state, ZIP, and coordinates.</small>
                @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="form-label form-label-custom">City</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="text" id="site-city" name="city" value="{{ old('city', $site->city ?? '') }}" />
                    @error('city')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-sm-6">
                    <label class="form-label form-label-custom">ZIP</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="text" id="site-zip" name="zip" maxlength="10" value="{{ old('zip', $site->zip ?? '') }}" />
                    @error('zip')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label form-label-custom">State (2-letter code)</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" id="site-state" name="state" maxlength="2" value="{{ old('state', $site->state ?? '') }}" />
                @error('state')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="panel">
            <h6 class="font-weight-bold mb-3">Site contact</h6>

            <div class="mb-3">
                <label class="form-label form-label-custom">Customer type <span class="text-danger">*</span></label>
                <select class="form-control form-control-styled form-input-padded layout-input-variant"
                        name="customer_type" required>
                    <option value="">— Select customer type —</option>
                    @foreach ($customerTypes as $type)
                        <option value="{{ $type->name }}"
                            @selected((string) $selectedCustomerType === (string) $type->name)>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_type')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">Bill to <span class="text-danger">*</span></label>
                <select class="form-control form-control-styled form-input-padded layout-input-variant"
                        name="bill_to" required>
                    <option value="">— Select billing account —</option>
                    @foreach ($billTos as $bt)
                        <option value="{{ $bt->id }}"
                            @selected((string) $selectedBillTo === (string) $bt->id)>
                            {{ $bt->bill_name }}
                        </option>
                    @endforeach
                </select>
                @error('bill_to')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="form-label form-label-custom">Arrival instructions</label>
                <textarea class="form-control form-control-styled textarea-styled-desc col-md-textarea"
                          rows="4" name="notes">{{ old('notes', $site->notes ?? '') }}</textarea>
                @error('notes')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="panel mb-4">
            <h6 class="font-weight-bold mb-3">Map &amp; service access</h6>

            <div class="map-placeholder map-placeholder-bg" id="site-map-preview">
                <div class="floating-map-badge" id="site-map-label">
                    {{ $site->name ?? 'New site' }} &middot; GPS
                    {{ $site->latitude ?? '—' }}, {{ $site->longitude ?? '—' }}
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-sm-6">
                    <label class="form-label form-label-custom">Latitude</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="text" id="latitude_display" value="{{ old('latitude', $site->latitude ?? '') }}"
                           placeholder="Auto-detected" readonly />
                </div>
                <div class="col-sm-6">
                    <label class="form-label form-label-custom">Longitude</label>
                    <input class="form-control form-control-styled form-input-padded layout-input-variant"
                           type="text" id="longitude_display" value="{{ old('longitude', $site->longitude ?? '') }}"
                           placeholder="Auto-detected" readonly />
                </div>
            </div>

            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $site->latitude ?? '') }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $site->longitude ?? '') }}">

            <div class="map-info-box mt-3">
                <i class="fi-rs-marker text-blue-main"></i>
                <span class="map-info-text" id="location-status">
                    Coordinates are detected automatically if location permission is allowed.
                </span>
            </div>
            <button class="btn bg-white font-weight-bold mt-3" type="button" id="get-location-button">
                Detect location
            </button>
        </div>

        <div class="panel">
            <h6 class="font-weight-bold mb-3">Status</h6>
            <div class="site-status-container-centered">
                <div class="site-status-pill site-status-inactive">Inactive</div>
                <div class="site-status-pill site-status-active">Active</div>
            </div>

            <h6 class="font-weight-bold mb-3 text-sm">Scheduling preferences</h6>
            <div class="mb-4">
                <label class="form-label form-label-custom">Default service window</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="text" name="hours" value="{{ old('hours', $site->hours ?? '') }}"
                       placeholder="Mon-Fri · 8:00 AM - 5:00 PM" />
                @error('hours')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label form-label-custom">CVS link</label>
                <input class="form-control form-control-styled form-input-padded layout-input-variant"
                       type="url" name="cvs_link" value="{{ old('cvs_link', $site->cvs_link ?? '') }}" />
                @error('cvs_link')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('sites.index') }}" class="btn bg-white font-weight-bold w-fixed-sm">Back</a>
    <button class="btn btn-success font-weight-bold text-white w-fixed-sm" type="submit">Save</button>
</div>

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addressInput = document.getElementById('site-address');
    const cityInput = document.getElementById('site-city');
    const stateInput = document.getElementById('site-state');
    const zipInput = document.getElementById('site-zip');
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const latDisplay = document.getElementById('latitude_display');
    const lngDisplay = document.getElementById('longitude_display');
    const status = document.getElementById('location-status');
    const locationButton = document.getElementById('get-location-button');
    const suggestionBox = document.getElementById('address-suggestions');
    const mapLabel = document.getElementById('site-map-label');
    const siteNameInput = document.querySelector('[name="name"]');

    let searchTimer = null;
    let requestController = null;

    function setCoordinates(latitude, longitude, message) {
        latInput.value = Number(latitude).toFixed(7);
        lngInput.value = Number(longitude).toFixed(7);
        latDisplay.value = latInput.value;
        lngDisplay.value = lngInput.value;
        updateMapLabel();
        if (message) status.textContent = message;
    }

    function updateMapLabel() {
        const name = siteNameInput && siteNameInput.value.trim() ? siteNameInput.value.trim() : 'Site';
        mapLabel.textContent = name + ' · GPS ' + (latInput.value || '—') + ', ' + (lngInput.value || '—');
    }

    function stateCode(address) {
        const code = address['ISO3166-2-lvl4'] || address['ISO3166-2-lvl3'] || '';
        if (code.includes('-')) return code.split('-').pop().toUpperCase().slice(0, 2);
        return (address.state || '').length === 2 ? address.state.toUpperCase() : '';
    }

    function applyAddressResult(item) {
        const a = item.address || {};
        addressInput.value = item.display_name || '';
        cityInput.value = a.city || a.town || a.village || a.municipality || a.hamlet || '';
        stateInput.value = stateCode(a);
        zipInput.value = a.postcode || '';
        setCoordinates(item.lat, item.lon, 'Address selected. City, state, ZIP, and coordinates were filled automatically.');
        suggestionBox.style.display = 'none';
        suggestionBox.innerHTML = '';
    }

    function renderSuggestions(items) {
        suggestionBox.innerHTML = '';
        if (!items || !items.length) {
            suggestionBox.style.display = 'none';
            return;
        }
        items.forEach(function (item) {
            const option = document.createElement('button');
            option.type = 'button';
            option.className = 'list-group-item list-group-item-action';
            option.textContent = item.display_name;
            option.style.cssText = 'display:block;width:100%;text-align:left;background:#fff;border:1px solid #dee2e6;padding:10px;cursor:pointer;';
            option.addEventListener('click', function () { applyAddressResult(item); });
            suggestionBox.appendChild(option);
        });
        suggestionBox.style.display = 'block';
    }

    addressInput.addEventListener('input', function () {
        clearTimeout(searchTimer);
        const query = addressInput.value.trim();
        if (query.length < 3) {
            suggestionBox.style.display = 'none';
            suggestionBox.innerHTML = '';
            return;
        }

        searchTimer = setTimeout(async function () {
            if (requestController) requestController.abort();
            requestController = new AbortController();
            try {
                const url = 'https://nominatim.openstreetmap.org/search?format=jsonv2&addressdetails=1&limit=5&q=' + encodeURIComponent(query);
                const response = await fetch(url, { signal: requestController.signal, headers: { 'Accept': 'application/json' } });
                if (!response.ok) throw new Error('Address search failed');
                renderSuggestions(await response.json());
            } catch (error) {
                if (error.name !== 'AbortError') {
                    status.textContent = 'Address suggestions are unavailable. You can enter the address manually.';
                    suggestionBox.style.display = 'none';
                }
            }
        }, 500);
    });

    document.addEventListener('click', function (event) {
        if (!suggestionBox.contains(event.target) && event.target !== addressInput) suggestionBox.style.display = 'none';
    });

    function detectLocation() {
        if (!navigator.geolocation) {
            status.textContent = 'This browser does not support location detection. Select an address suggestion instead.';
            return;
        }
        status.textContent = 'Requesting device location…';
        locationButton.disabled = true;
        navigator.geolocation.getCurrentPosition(function (position) {
            setCoordinates(position.coords.latitude, position.coords.longitude,
                'Device location detected. This is your current device location, not necessarily the site address.');
            locationButton.disabled = false;
        }, function (error) {
            let message = 'Could not detect device location. Select an address suggestion to fill coordinates.';
            if (error.code === 1) message = 'Location permission denied. Allow location access in browser settings, or select an address suggestion.';
            if (error.code === 2) message = 'Device location unavailable. Select an address suggestion to fill coordinates.';
            if (error.code === 3) message = 'Location request timed out. Retry or select an address suggestion.';
            status.textContent = message;
            locationButton.disabled = false;
        }, { enableHighAccuracy: true, timeout: 20000, maximumAge: 60000 });
    }

    locationButton.addEventListener('click', detectLocation);
    if (siteNameInput) siteNameInput.addEventListener('input', updateMapLabel);
});
</script>
@endpush
