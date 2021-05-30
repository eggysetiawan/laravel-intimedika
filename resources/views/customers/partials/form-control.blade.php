<div class="card-body">
    <livewire:superadmin.user />


    @if (!$nohospital)
        <livewire:customers.hospital />
    @else
        <a href="{{ route('customers.create') }}" class="btn btn-outline-success form-control"
            data-aos="zoom-out">Munculkan
            Rumah Sakit</a>
    @endempty

    <div class="form-group">
        <label for="name">Perusahaan</label>
        <input type="text" class="form-control @error('name') is-invalid @else is-valid @enderror" id="name"
            name="name" placeholder="Masukan Nama" wire:model.debounce.500ms="name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="person_in_charge">Nama PIC</label>
        <input type="text" class="form-control @error('person_in_charge') is-invalid @enderror"
            id="person_in_charge" name="person_in_charge" placeholder="Masukan Nama PIC">
        @error('person_in_charge')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="role">Jabatan</label>
        <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role"
            placeholder="Masukan Jabatan PIC">
        @error('role')
            <span class=" invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="mobile">Hp Customer</label>
        <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
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
        <label for="address">Alamat</label>
        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="5"
            placeholder="Masukan alamat customer.."></textarea>
    </div>



</div>
<!-- /.card-body -->

<div class="card-footer">
<x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
