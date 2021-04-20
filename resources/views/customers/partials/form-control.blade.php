<div class="card-body">
    <x-testing-user></x-testing-user>


    @empty($nohospital)
        <div class="form-group">
            <label for="hospital">Pilih Rumah Sakit</label>
            <x-hospitals></x-hospitals>

            <span class="input-group-append">
                <a class="btn bg-teal btn-flat" target="_blank" href="{{ route('hospitals.create') }}"
                    title="Rumah Sakit tidak ditemukan? tambahkan disini.">+</a>
                <a class="btn btn-danger btn-flat fa fa-times-circle" href="{{ route('customers.create-2') }}"
                    title="Hilangkan Rumah Sakit"></a>
            </span>
            @error('hospital')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror

        </div>
    @else
        <a href="{{ route('customers.create') }}" class="btn btn-secondary  form-control">Munculkan Rumah Sakit</a>
        <input type="hidden" name="hospital" value="false">
    @endempty

    <div class="form-group">
        <label for="name">Nama/Perusahaan</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            placeholder="Masukan Nama" value="{{ old('name') ?? $customer->name }}">
        @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="role">Jabatan</label>
        <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role"
            placeholder="Masukan Jabatan" value="{{ old('role') ?? $customer->role }}">
        @error('role')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="mobile">Hp Kunjungan</label>
        <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
            placeholder="Masukan Nomor Hp" value="{{ old('mobile') ?? $customer->mobile }}">
        @error('mobile')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            placeholder="Masukan Email" value="{{ old('email') ?? $customer->email }}">
        @error('email')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="address">Alamat</label>
        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="5">
        {{ old('address') ?? $customer->address }}
        </textarea>
    </div>



</div>
<!-- /.card-body -->

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
