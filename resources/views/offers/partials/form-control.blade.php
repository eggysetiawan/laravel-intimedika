<div class="card-body">
    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label>No Penawaran</label>
            <label>Tanggal Penawaran</label>
        </div>

        <div class="row">

            <div class="col-md-6">
                <input type="number" name="queue" class="form-control @error('queue') is-invalid @enderror" id="queue"
                    value="{{ old('queue') }}" placeholder="Nomor Penawaran" max="999">
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" name="date" id="datemask"
                        class="form-control @error('date') is-invalid @enderror" data-inputmask-alias="datetime"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask max="2021-01-01">
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="form-group">
        <label for="customer">Pilih Customer</label>
        <div class="input-group">
            <select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror select2">

                {{-- for edit --}}
                @isset($offer->customer->customer_id)
                    <option value="{{ $offer->customer->id }}" selected>
                        {{ $offer->customer->hospitals->first()->name ?? $offer->customer->name }}
                    </option>
                @endisset
                <option disabled selected>Pilih Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">
                        {{ $customer->hospitals->first()->name ?? $customer->name }}
                    </option>
                @endforeach
            </select>

        </div>
        @error('customer')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group mb-5">
        <label for="budget">Sumber Dana</label>
        <select name="budget" id="budget" class="form-control @error('budget') is-invalid @enderror">
            <option value="APBN">APBN</option>
            <option value="APBN-P">APBN-P</option>
            <option value="APBD">APBD</option>
            <option value="BLUD">BLUD</option>
            <option value="DAK">DAK</option>
            <option value="Swasta">Swasta</option>
        </select>
        @error('budget')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="d-flex justify-content-center mt-5">
        <dt class="text-lg ">Alat Kesehatan</dt>
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

    <div class="form-group mt-5">
        <label for="price_note">Keterangan Harga</label>
        <textarea name="price_note" id="price_note" rows="2" class="form-control"
            placeholder="cth: Franko Jakarta - Belum termasuk pajak">{{ old('quantity') }}</textarea>
    </div>
    <div class="form-group">
        <label for="warranty_note">Garansi</label>
        <textarea name="warranty_note" id="warranty_note" rows="2" class="form-control"
            placeholder="cth: 1 tahun sevice & spare-part">{{ old('quantity') }}</textarea>
    </div>
    <div class="form-group">
        <label for="availability_note">Ketersediaan</label>
        <textarea name="availability_note" id="availability_note" rows="2" class="form-control"
            placeholder="cth: Ready stock / Indent">{{ old('quantity') }}</textarea>
    </div>
    <div class="form-group">
        <label for="payment_note">Keterangan Pembayaran</label>
        <textarea name="payment_note" id="payment_note" rows="2" class="form-control"
            placeholder="cth: DP 50%">{{ old('quantity') }}</textarea>
    </div>
    <div class="form-group">
        <label for="note">Keterangan Tambahan</label>
        <textarea name="note" id="note" rows="2"
            class="form-control">Harga sewaktu-waktu dapat berubah tanpa pemberitahuan..</textarea>
    </div>


</div>
<!-- /.card-body -->

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
