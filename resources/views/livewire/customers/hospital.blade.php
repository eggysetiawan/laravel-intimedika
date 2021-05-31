<div>
    @if (!$nohospital)
        <div class="form-group" data-aos="zoom-in">
            <label for="hospital">Pilih Rumah Sakit</label>
            <span class="input-group-append">
                <x-hospitals></x-hospitals>
                <a class="btn bg-teal btn-flat" target="_blank" href="{{ route('hospitals.create') }}"
                    title="Rumah Sakit tidak ditemukan? tambahkan disini.">+</a>
                {{-- @if ($canHide) --}}
                <a class="btn btn-danger btn-flat fa fa-times-circle" href="#!" wire:click.prevent="hideHospital"
                    title="Hilangkan Rumah Sakit"></a>
                {{-- @endif --}}

            </span>
            @error('hospital')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    @else
        <a href="#" class="btn btn-outline-success form-control" data-aos="zoom-in"
            wire:click.prevent="showHospital">Munculkan
            Rumah Sakit</a>
    @endempty
</div>
