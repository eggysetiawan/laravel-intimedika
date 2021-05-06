<div class="card-body">
    <div class="form-group">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <label for="service_tag">Service Tag</label>
                <input type="text" name="service_tag" id="service_tag" placeholder="Input service tag disini.."
                    class="form-control" value="{{ old('service_tag') ?? $inventory->service_tag }}">
            </div>
            <div class="col-md-6">
                <label for="serial_number">Serial Number</label>
                <input type="text" name="serial_number" id="serial_number" placeholder="Input serial number disini.."
                    class="form-control" value="{{ old('serial_number') ?? $inventory->serial_number }}">
            </div>
        </div>

    </div>

    <div class="form-group">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <label for="item">Nama Barang</label>
                <input type="text" name="item" id="item" class="form-control" placeholder="Input nama barang.."
                    class="{{ old('item') ?? $inventory->item }}">
            </div>
            <div class="col-md">
                <label for="quantity">Jumlah/Unit</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="qty"
                    value="{{ old('quantity') ?? $inventory->quantity }}">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="type">Jenis Barang</label>
        <select name="type" id="type" class="form-control type">
            @foreach ($types as $type)
                <option value="{{ $type->name }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="user">Nama User</label>
        <input type="text" name="user" id="user" class="form-control" value="{{ old('user') ?? $inventory->user }}"
            placeholder="Tulis nama pengguna..">
    </div>

    <div class="form-group">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <label for="location">Lokasi</label>
                <input type="text" name="location" id="location" class="form-control"
                    placeholder="Tuliskan lokasi barang saat ini.."
                    class="{{ old('location') ?? $inventory->location }}">
            </div>
            <div class="col-md-6">
                <label for="department">Departement/Divisi</label>
                <select name="department" id="department" class="form-control">
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="purchase_date">Tanggal Pembelian</label>
        <input type="date" name="purchase_date" id="purchase_date" class="form-control"
            value="{{ old('purchase_date') ?? ($inventory->purchase_date ?? now()->format('Y-m-d')) }}">
    </div>

    <div class="form-group">
        <label for="note">Keterangan</label>
        <textarea name="note" id="note" rows="3" placeholder="Keterangan barang"
            class="form-control">{{ old('note') ?? $inventory->note }}</textarea>
    </div>

</div>

<div class="card-footer">
    <x-button-submit>Submit</x-button-submit>
</div>
