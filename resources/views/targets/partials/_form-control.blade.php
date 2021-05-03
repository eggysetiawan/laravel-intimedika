<div class="card-body">
    <x-testing-user></x-testing-user>

    <div class="form-group">
        <label for="year">Pilih Tahun Target</label>
        <input list="years" name="year" id="year" class="form-control">
        <datalist id="years">
            <option value="2019">
            <option value="2020">
            <option value="2021">
        </datalist>
        </select>
    </div>
    <div class="form-group">
        <label for="target">Masukkan Target anda</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Rp</span>
            </div>
            <input type="text" name="target" id="price" class="form-control @error('target') is-invalid @enderror"
                data-inputmask="'mask': ['9,999','99,999','999,999','9,999,999', '99,999,999', '99,999,999', '999,999,999','9,999,999,999','99,999,999,999','999,999,999,999','9,999,999,999,999','99,999,999,999,999','999,999,999,999,999']"
                data-mask value="{{ old('target') ?? $target->target }}" required>
        </div>
    </div>
</div>

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
