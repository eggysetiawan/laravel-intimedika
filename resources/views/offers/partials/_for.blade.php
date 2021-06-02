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

                <select name="modalities[]" id="modality{{ $i }}"
                    class="form-control select2 @error('modalities.' . $i) is-invalid @enderror">
                    <option selected disabled>Pilih Alat</option>
                    @foreach ($modalities as $modality)
                        <option value="{{ $modality->id }}">
                            {{ $modality->name . ' - ' . $modality->model }} (@currency($modality->price))
                        </option>
                    @endforeach
                </select>
                @error('modalities.' . $i)
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

        </div>

        <div class="d-flex row">
            <div class="col-md-12">
                <label for="prices.{{ $i }}">Harga Penawaran #{{ $i }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" name="prices[]" id="price"
                        class="form-control @error('prices.' . $i) is-invalid @enderror"
                        data-inputmask="'mask': ['9,999','99,999','999,999','9,999,999', '99,999,999', '99,999,999', '999,999,999','9,999,999,999','99,999,999,999','999,999,999,999','9,999,999,999,999','99,999,999,999,999','999,999,999,999,999']"
                        data-mask value="{{ old('prices.' . ($i - 1)) }}" required>
                </div>

                @error('prices.' . $i)
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="d-flex row">
            <div class="col-md-12">
                <label for="qty.{{ $i }}">Qty #{{ $i }}</label>
                <div class="input-group mb-3">
                    <input type="number" min="0" name="qty[]" id="price"
                        class="form-control @error('qty.' . $i) is-invalid @enderror"
                        value="{{ old('qty.' . ($i - 1)) }}">
                    <div class="input-group-append">
                        <span class="input-group-text">pcs/unit</span>
                    </div>
                </div>

                @error('qty.' . $i)
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

    </div>
@endfor
