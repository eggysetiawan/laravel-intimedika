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

@empty($customer->name)
    <div class="form-group">
        <label for="request">Permintaan</label>
        <textarea name="request" id="request" class="form-control @error('request') is-invalid @enderror" cols="30" rows="4"
            placeholder="Tuliskan Hasil Kunjungan Harian">{{ old('request') }}</textarea>
        @error('request')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="result">Hasil Kunjungan</label>
        <textarea name="result" id="result" class="form-control @error('result') is-invalid @enderror" cols="30" rows="10"
            placeholder="Tuliskan Hasil Kunjungan Harian">{{ old('result') }}</textarea>
        @error('result')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <input type="file" name="img" id="img" class="form-control @error('img') is-invalid @enderror">
        @error('img')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
@endempty
