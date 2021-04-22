<div class="form-group">
    <label for="customer">Pilih Customer</label>
    <div class="input-group">
        <select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror select2">

            {{-- for edit --}}
            @isset($offer->customer_id)
                <option value="{{ $offer->customer_id }}" selected>
                    {{ $offer->customer->hospitals->first()->name ?? $offer->customer->name }}
                </option>
            @else
                <option disabled selected>Pilih Customer</option>
            @endisset

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
    <select name="budget" id="budget" class="select2 form-control @error('budget') is-invalid @enderror">
        @isset($offer->budget)
            <option value="{{ $offer->budget }}" selected>{{ $offer->budget }}</option>

            <option value="APBN">APBN</option>
            <option value="APBN-P">APBN-P</option>
            <option value="APBD">APBD</option>
            <option value="BLUD">BLUD</option>
            <option value="DAK">DAK</option>
            <option value="Swasta">Swasta</option>
        @else
            <option value="APBN">APBN</option>
            <option value="APBN-P">APBN-P</option>
            <option value="APBD">APBD</option>
            <option value="BLUD">BLUD</option>
            <option value="DAK">DAK</option>
            <option value="Swasta">Swasta</option>
        @endisset
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

@isset($offer->invoices->first()->orders)
    @include('funnels.partials._while')
@else
    @include('offers.partials._for')
@endisset

<div class="form-group mt-5">
    <label for="price_note">Keterangan Harga</label>
    <textarea name="price_note" id="price_note" rows="2" class="form-control"
        placeholder="cth: Franko Jakarta - Belum termasuk pajak">{{ old('price_note') ?? $offer->price_note }}</textarea>
</div>
<div class="form-group">
    <label for="warranty_note">Garansi</label>
    <textarea name="warranty_note" id="warranty_note" rows="2" class="form-control"
        placeholder="cth: 1 tahun sevice & spare-part">{{ old('warranty_note') ?? $offer->warranty_note }}</textarea>
</div>
<div class="form-group">
    <label for="availability_note">Ketersediaan</label>
    <textarea name="availability_note" id="availability_note" rows="2" class="form-control"
        placeholder="cth: Ready stock / Indent">{{ old('availability_note') ?? $offer->availability_note }}</textarea>
</div>
<div class="form-group">
    <label for="payment_note">Keterangan Pembayaran</label>
    <textarea name="payment_note" id="payment_note" rows="2" class="form-control"
        placeholder="cth: DP 50%">{{ old('payment_note') ?? $offer->payment_note }}</textarea>
</div>
<div class="form-group">
    <label for="note">Keterangan Tambahan</label>
    <textarea name="note" id="note" rows="2"
        class="form-control">Harga sewaktu-waktu dapat berubah tanpa pemberitahuan..</textarea>
</div>
