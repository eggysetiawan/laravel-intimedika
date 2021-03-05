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
                    value="{{ old('date') ?? $funnel->date }}">
                @error('date')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
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

    @for ($i = 1; $i <= $count; $i++)
        <div class="form-group my-4">
            {{-- references --}}
            <div class="d-flex row">
                <div class="col-md-12">
                    <label for="references{{ $i }}">Referensi Penawaran #{{ $i }}</label>
                    <select name="references[]" id="references" class="form-control">
                        <option value="E-Catalogue">E-Catalogue</option>
                        <option value="Non E-Catalogue">Non E-Catalogue</option>
                    </select>
                    @error('references.' . $i)
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <label for="modality{{ $i }}">Alat Kesehatan #{{ $i }}</label>
            <div class="d-flex row">
                {{-- modality --}}
                <div class="col-md-12">

                    <select name="modality[]" id="modality{{ $i }}"
                        class="form-control select2 @error('modality.' . $i) is-invalid @enderror">
                        <option selected disabled>Pilih Alat</option>
                        @foreach ($modalities as $modality)
                            <option value="{{ $modality->id }}">
                                {{ $modality->name . ' - ' . $modality->model }} (@currency($modality->price))
                            </option>
                        @endforeach
                    </select>
                    @error('modality.' . $i)
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>

            <div class="d-flex row">
                <div class="col-md-12">
                    <label for="price{{ $i }}">Harga Penawaran #{{ $i }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" name="price[]" id="price"
                            class="form-control @error('price.' . $i) is-invalid @enderror"
                            data-inputmask="'mask': ['9.999','99.999','999.999','9.999.999', '99.999.999', '99.999.999', '999.999.999','9.999.999.999','99.999.999.999','999.999.999.999','9.999.999.999.999','99.999.999.999.999','999.999.999.999.999']"
                            data-mask value="{{ old('price.' . $i) }}" required>
                    </div>

                    @error('price.' . $i)
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>



    @endfor

</div>

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
