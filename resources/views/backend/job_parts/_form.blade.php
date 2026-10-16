<div class="row g-4">
    <div class="col-12">
        <div class="panel">
            <h6 class="font-weight-bold mb-3">
                Job part details
            </h6>
            <div class="mb-3">
                <label class="form-label form-label-custom">
                    Work order *
                </label>
                <select name="work_order_id" class="form-control form-control-styled form-input-padded layout-input-variant" required>
                    <option value="">
                        Select work order
                    </option>
                    @foreach($workOrders as $wo)
                    <option value="{{ $wo->id }}" @selected((string)old('work_order_id',$jobPart->work_order_id ?? '') === (string)$wo->id)>
                        {{ $wo->customer_work_order ?: ('WO-'.$wo->id) }}
                    </option>
                        @endforeach
                    </select>@error('work_order_id')
                    <div class="text-danger small">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label form-label-custom">
                        Part *
                    </label>
                    <select name="part_id" class="form-control form-control-styled form-input-padded layout-input-variant" required>
                        <option value="">
                            Select part
                        </option>
                        @foreach($parts as $part)
                        <option value="{{ $part->id }}" @selected((string)old('part_id',$jobPart->part_id ?? '') === (string)$part->id)>
                            {{ $part->part_number }} @if($part->description) — {{ \Illuminate\Support\Str::limit($part->description,60) }} @endif
                        </option>
                        @endforeach
                    </select>
                    @error('part_id')
                    <div class="text-danger small">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label form-label-custom">
                        Quantity *
                    </label>
                    <input type="number" name="quantity" class="form-control form-control-styled form-input-padded layout-input-variant" value="{{ old('quantity',$jobPart->quantity ?? '0') }}" required>
                    @error('quantity')
                    <div class="text-danger small">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input type="hidden" name="ordered" value="0">
                    <input class="form-check-input" type="checkbox" id="ordered" name="ordered" value="1" @checked(old('ordered',$jobPart->ordered ?? false))>
                    <label class="form-check-label" for="ordered">
                        Part ordered
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="display-flex justify-content-end gap-3 mt-4 mb-5">
    <a href="{{ route('job-parts.index') }}" class="btn bg-white font-weight-bold btn-back-custom">Cancel</a>
    <button type="submit" class="btn btn-success text-white font-weight-bold btn-primary-custom">
        {{ isset($jobPart) ? 'Update Job Part' : 'Save Job Part' }}
    </button>
</div>
</div>

