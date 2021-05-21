<div class="card-body">

    <div class="form-group">
        <label for="name">Nama Rumah Sakit*</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            placeholder="Masukan Nama" value="{{ old('name') ?? $hospital->name }}">
        @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="code">Kode Rumah Sakit</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
            placeholder="Masukan Kode Rumah Sakit" value="{{ old('code') ?? $hospital->code }}">
        @error('code')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="phone">Tlp Rumah Sakit*</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
            placeholder="Masukan Nomor Telepon" value="{{ old('phone') ?? $hospital->phone }}">
        @error('phone')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="city">Provinsi*</label>
        <select name="city" id="city" class="form-control select2" data-dependent="district">
            @isset($hospital->city)
                <option value="{{ $hospital->city }}" selected>{{ $hospital->city }}</option>
                @foreach ($provinces as $province)
                    @if ($hospital->city != $province['nama'])
                        <option value="{{ $province['nama'] }}">{{ $province['nama'] }}</option>
                    @endempty
                @endforeach
            @else
                @foreach ($provinces as $province)
                    <option value="{{ $province['id'] }}">{{ $province['nama'] }}</option>
                @endforeach
            @endisset

    </select>
    @error('city')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
{{-- <div class="form-group">
        <label for="district">Kota*</label>
        <select name="district" id="district" class="form-control">
            <option selected disabled>Pilih Kota</option>
            @foreach ($districts as $district)
                <option value="{{ $district-> }}"></option>
            @endforeach
        </select>
        @error('district')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div> --}}

<div class="form-group">
    <label for="class">Kelas/Tipe*</label>
    <select name="class" id="class" class="form-control">
        @isset($hospital->class)
            <option value="{{ $hospital->class }}">Kelas {{ $hospital->class }}</option>

        @else
            <option selected disabled>Pilih Kelas</option>
        @endisset
        <option value="A">Kelas A</option>
        <option value="B">Kelas B</option>
        <option value="C">Kelas C</option>
        <option value="D">Kelas D</option>
    </select>
</div>


<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
        placeholder="Masukan Email" value="{{ old('email') ?? $hospital->email }}">
    @error('email')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>


<div class="form-group">
    <label for="address">Alamat*</label>
    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30"
        rows="4"
        placeholder="Masukkan alamat rumah sakit..">{{ old('address') ?? $hospital->address }}</textarea>
    @error('address')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>



</div>
<!-- /.card-body -->

<div class="card-footer">
<x-button-submit> {{ $submit ?? 'Update' }}</x-button-submit>
</div>
