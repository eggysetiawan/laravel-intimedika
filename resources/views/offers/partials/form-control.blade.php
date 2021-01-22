<div class="card-body">
    <div class="form-group">
        <label for="customer">Pilih Customer</label>
        <div class="input-group">
            <select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror select2">
                @isset($offer->customer->customer_id)
                    <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                @endisset
                <option disabled selected>Pilih Customer</option>

                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
            <span class="input-group-append">
                <a class="btn bg-warning btn-flat" href="{{ route($routes) }}"></a>
            </span>
        </div>
        @error('hospital')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>


</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn bg-teal">{{ $submit ?? 'Update' }}</button>
</div>
