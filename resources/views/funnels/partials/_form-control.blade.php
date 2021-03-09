<div class="card-body">
    {{-- customer/rumah sakit --}}
    <div class="form-group">
        <label for="customer">Pilih Customer/Rumah Sakit</label>
        <select name="customer" id="customer" class="select2 form-control @error('customer') is-invalid @enderror">
            @if ($offer->customer_id)

                <option value="{{ $offer->customer_id }}">
                    {{ $offer->customer->hospitals->first()->name ?? $offer->customer->name }}</option>

            @else

                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->hospitals->first()->name ?? $customer->name }}
                    </option>
                @endforeach

            @endif
        </select>
        @error('customer')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- tanggal --}}
    <div class="form-group">
        <div class="row">
            <div class="div col-md-6">
                <label for="date">Tanggal</label>
                <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                    value="{{ old('date') ?? $funnel->date }}" @if ($funnel->date) disabled @endif>
                @error('date')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            {{-- progress --}}
            <div class="div col-md-6">
                <label for="progress">Progress</label>
                <select name="progress" id="progress" class="form-control @error('progress') is-invalid @enderror">
                    @for ($i = 10; $i <= 100; $i += 10)
                        <option value="{{ $i }}">{{ $i . ' %' }}</option>
                    @endfor
                </select>
                @error('progress')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="description">Keterangan</label>
        <textarea name="description" id="description" cols="30"
            class="form-control @error('description')is-invalid @enderror"
            rows="4">{{ old('description') ?? $funnel->description }}</textarea>
    </div>

    @isset($funnel->progress)
        @include('funnels.partials._while')
    @else
        @include('funnels.partials._for')
    @endisset

</div>

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
