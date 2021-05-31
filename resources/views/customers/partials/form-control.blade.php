<div class="card-body">

    <livewire:superadmin.user />
    <livewire:customers.hospital />

    <div class="form-group">
        <label for="name">Perusahaan/Institusi</label>
        <input type="text" class="form-control @error('name') is-invalid @else is-valid @enderror" id="name" name="name"
            placeholder="Masukan nama Perusahaan/Institusi.." wire:model.debounce.500ms="name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="person_in_charge">Nama PIC</label>
        <input type="text" class="form-control @error('person_in_charge') is-invalid @else is-valid @enderror"
            id="person_in_charge" name="person_in_charge" placeholder="Masukan Nama PIC"
            wire:model.debounce.500ms="person_in_charge">
        @error('person_in_charge')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="role">Jabatan</label>
        <input type="text" class="form-control @error('role') is-invalid @else is-valid @enderror" id="role" name="role"
            placeholder="Masukan Jabatan PIC" wire:model.debounce.500ms="role">
        @error('role')
            <span class=" invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="mobile">Hp Customer</label>
        <input type="number" class="form-control @error('mobile') is-invalid @else is-valid @enderror" id="mobile"
            name="mobile" placeholder="Masukan Nomor Hp" wire:model.debounce.500ms="mobile" min="0">
        @error('mobile')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @else is-valid @enderror" id="email"
            name="email" placeholder="Masukan Email" wire:model.debounce.500ms="email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="address">Alamat</label>
        <textarea name="address" id="address" class="form-control @error('address') is-invalid @else is-valid @enderror"
            rows="5" placeholder="Masukan alamat customer.." wire:model.debounce.500ms="address"></textarea>
    </div>

</div><!-- /.card-body -->


<div class="card-footer">
    <x-button-submit>
        {{ $submit ?? 'Update' }}</x-button-submit>
</div>
