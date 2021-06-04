<div>
    <div class="card-body">
        <livewire:superadmin.user />
        <div class="form-group">
            <label for="hospital">Rumah Sakit</label>
            <div class="input-group">
                <select name="hospital" id="hospitals"
                    class="form-control @error('hospital') is-invalid @else is-valid @enderror"
                    wire:model.debounce.500ms="hospital">
                    <option value="" selected>Piih Rumah Sakit</option>
                    @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}">{{ $hospital->name . ' - ' . $hospital->city }}</option>
                    @endforeach
                </select>
                {{ $label }}
                <span class="input-group-append">
                    <a class="btn btn-teal bg-teal btn-flat" target="_blank" href="{{ route('hospitals.create') }}"
                        title="Rumah Sakit belum ada dalam daftar? klik disini untuk menambahkan.">+</a>
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
                placeholder="Masukan Nama">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="mobile">Hp Kunjungan</label>
            <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
                placeholder="Masukan Nomor Hp">
            @error('mobile')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder="Masukan Email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="role">Jabatan</label>
            <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                placeholder="Masukan Jabatan">
            @error('role')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>



        <div class="form-group">
            <label for="request">Permintaan</label>
            <textarea name="request" id="request" class="form-control @error('request') is-invalid @enderror" cols="30"
                rows="4" placeholder="Tuliskan Hasil Kunjungan Harian"></textarea>
            @error('request')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="result">Hasil Kunjungan</label>
            <textarea name="result" id="result" class="form-control @error('result') is-invalid @enderror" cols="30"
                rows="10" placeholder="Tuliskan Hasil Kunjungan Harian"></textarea>
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





    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
    </div>

</div>
