<div class="card-body">
    <div class="form-group">
        <label for="hospital">Pilih Rumah Sakit</label>
        <div class="input-group">
            <select name="hospital" id="hospital" class="form-control @error('hospital') is-invalid @enderror select2">
                <option selected disabled>Pilih Rumah Sakit</option>
                @isset($customer->hospital_id)
                    <option value="{{ $customer->hospital->id }}" selected>
                        {{ $customer->hospital->name . ' - ' . $customer->hospital->city }}
                    </option>
                @endisset
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name . ' - ' . $hospital->city }}</option>
                @endforeach
            </select>
            <span class="input-group-append">
                <a class="btn btn-primary btn-flat" target="_blank" href="{{ route('hospitals.create') }}">+</a>
            </span>
            @error('hospital')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>
    <div class="form-group">
        <label for="name">Nama</label>
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
        <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
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




</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>
</div>
