<div class="card-body">
    <div class="form-group">
        <label for="customer">Pilih Customer</label>
        <div class="input-group">
            <select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror select2">

                {{-- for edit --}}
                @isset($offer->customer->customer_id)
                    @php
                    $name = (request()->segment(3) == "edit") ? $offer->customer->name :
                    $offer->customer->hospitals->first()->name;
                    @endphp
                    <option value="{{ $offer->customer->id }}" selected>{{ $name }}</option>
                @endisset
                <option disabled selected>Pilih Customer</option>


                @foreach ($customers as $customer)
                    @php
                    $name = (request()->segment(2) == 'create-cust') ? $customer->name :
                    $customer->hospitals->first()->name. ' - '.$customer->name;
                    @endphp
                    <option value="{{ $customer->id }}">{{ $name }}</option>
                @endforeach
            </select>
            <span class="input-group-append">
                <a class="btn {{ $attr['color'] }} btn-flat" href="{{ route($attr['routes']) }}">{{ $attr['icon'] }}</a>
            </span>
        </div>
        @error('hospital')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="budget">Sumber Dana</label>
        <select name="" id=""></select>
        @error('budget')
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
