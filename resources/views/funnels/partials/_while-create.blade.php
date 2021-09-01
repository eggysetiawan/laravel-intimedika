@foreach ($offer->invoices->first()->orders as $order)
    @php
        $i++;
    @endphp
    <div class="form-group my-4">
        {{-- references --}}
        <div class="d-flex row">
            <div class="col-md-12">
                <label for="references{{ $i }}">Referensi Penawaran #{{ $i }}</label>
                <select name="references[]" id="references" class="form-control">
                    <option value="{{ $order->references }}" selected>{{ $order->references }}</option>
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
                    <option selected value="{{ $order->modality_id }}">{{ $order->modality->name }}</option>
                    @foreach ($modalities as $modality)
                        @if ($modality->id != $order->modality_id)
                            <option value="{{ $modality->id }}">
                                {{ $modality->name . ' - ' . $modality->model }} (@currency($modality->price))
                            </option>
                        @endif
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
                    <input type="text" name="price[]" id="price"
                        class="form-control @error('price.' . $i) is-invalid @enderror"
                        value="{{ old('price.' . $i) ?? $order->price }}" required
                        data-inputmask="'mask': ['9,999','99,999','999,999','9,999,999', '99,999,999', '99,999,999', '999,999,999','9,999,999,999','99,999,999,999','999,999,999,999','9,999,999,999,999','99,999,999,999,999','999,999,999,999,999']"
                        data-mask>
                </div>

                @error('price.' . $i)
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

                    <input type="text" name="qty[]" id="price"
                        class="form-control @error('qty.' . $i) is-invalid @enderror"
                        value="{{ old('qty.' . $i) ?? $order->quantity }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text">unit/pcs</span>
                    </div>
                </div>

                @error('price.' . $i)
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>
@endforeach
