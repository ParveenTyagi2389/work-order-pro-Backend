<div class="row g-4">
    <div class="col-lg-7">
        <div class="panel mb-4">
            <h6 class="font-weight-bold mb-3">Technician payroll details</h6>
            {{-- <div class="mb-3">
                <label class="form-label form-label-custom">
                    Tech Payroll UID *
                </label>
                <input name="tech_payroll_uid" required maxlength="50" class="form-control form-control-styled form-input-padded layout-input-variant" value="{{ old('tech_payroll_uid',$payroll->tech_payroll_uid ?? '') }}">
                @error('tech_payroll_uid')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label class="form-label form-label-custom">Technician *</label>
                <select name="technician_id" required class="form-control form-control-styled form-input-padded layout-input-variant">
                    <option value="">Select technician</option>
                    @foreach($technicians as $technician)
                        <option value="{{ $technician->id }}" @selected((string)old('technician_id',$payroll->technician_id ?? '')===(string)$technician->id)>
                            {{ $technician->name }} (ID: {{ $technician->id }})
                        </option>
                    @endforeach
                </select>
                @error('technician_uid')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Time In / Out *</label>
                <input type="datetime-local" name="time_in_out" required class="form-control form-control-styled form-input-padded layout-input-variant" value="{{ old('time_in_out',isset($payroll)&&$payroll->time_in_out?$payroll->time_in_out->format('Y-m-d\TH:i'):'') }}">
                @error('time_in_out')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label form-label-custom">Notes</label>
                <textarea name="notes" rows="4" class="form-control form-control-styled textarea-styled-desc">{{ old('notes',$payroll->notes ?? '') }}</textarea>
                @error('notes')
                <div class="text-danger small">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @foreach(['authorized'=>'Authorized','paid'=>'Paid','paid_check'=>'Paid Check'] as $key=>$label)
                <div class="form-check mb-3">
                    <input type="hidden" name="{{ $key }}" value="0">
                    <input class="form-check-input" type="checkbox" name="{{ $key }}" value="1" id="{{ $key }}" @checked((bool)old($key,$payroll->$key ?? false))>
                    <label class="form-check-label" for="{{ $key }}">
                        {{ $label }}
                    </label>
                    @error($key)
                    <div class="text-danger small">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('technician-payroll.index') }}" class="btn-back-custom">Cancel</a>
    <button type="submit" class="btn-primary-custom">
        {{ isset($payroll)?'Update Payroll':'Save Payroll' }}
    </button>
</div>