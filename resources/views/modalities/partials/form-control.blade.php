<div class="card-body">
    <x-testing-user></x-testing-user>

    <div class="form-group">
        <label for="name">Nama Alat</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            placeholder="cth: CT Injection System" value="{{ old('name') ?? $modality->name }}">
        @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="model">Model</label>
        <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model"
            placeholder="cth: Salient S/Salient D" value="{{ old('model') ?? $modality->model }}">
        @error('model')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="brand">Merk</label>
        <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand"
            placeholder="cth: AGFA/Medrad/Intiwid" value="{{ old('brand') ?? $modality->brand }}">
        @error('brand')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Harga</label>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
            placeholder="cth: 1000" value="{{ old('price') ?? $modality->price }}">
        @error('price')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="unit">Nama Satuan</label>
        <select name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror">
            <option value="carton">carton</option>
            <option value="lot">lot</option>
            <option value="pce">pce/pcs</option>
            <option value="set">set</option>
            <option value="unit">unit</option>
        </select>
        @error('unit')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="stock">Stok</label>
        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
            placeholder="cth: 0" value="{{ old('stock') ?? $modality->stock }}">
        @error('stock')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="category">Tipe</label>
                <select name="category" id="category" class="form-control">
                    @isset($modality->category)
                        <option value="{{ $modality->category }}" selected>{{ $modality->category }}</option>
                    @else
                        <option selected disabled>Pilih Tipe</option>
                    @endisset
                    <option value="BHP">Bahan Habis Pakai(BHP)</option>
                    <option value="Modality">Alat/Modality</option>
                    <option value="Software">Software</option>
                </select>
                @error('category')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="reference">Referensi</label>
                <select name="reference" id="reference" class="form-control">
                    @isset($modality->reference)
                        <option selected value="{{ $modality->reference }}">{{ $modality->reference }}</option>
                    @else
                        <option selected disabled>Pilih Referensi</option>
                    @endisset
                    <option value="E-Catalogue">E-Catalogue</option>
                    <option value="Non E-Catalogue">Non E-Catalogue</option>
                </select>
                @error('reference')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="spec">Spesifikasi Alat</label>
        <textarea name="spec" id="spec" class="form-control @error('spec') is-invalid @enderror" cols="30" rows="4"
            placeholder="Tuliskan spesifikasi alat/software disini">@empty($modality->spec){{ old('spec') ?? null }} @else {{ old('spec') ?? '<pre class="wordwrap">' . $modality->spec . '</pre>' }} @endempty</textarea>
        {{-- <div id="spec">{{ old('spec') ?? $modality->spec }}</div> --}}
        @error('spec')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

</div>
<!-- /.card-body -->

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
