<div>
    <div class="form-group">
        <label for="hospital">Pilih Rumah Sakit</label>
        <span class="input-group-append">
            <select name="hospital" id="hospital"
                class="form-control @error('hospital') is-invalid @else is-valid @enderror"
                wire:model.debounce.500ms="hospital">
            </select>

            <a class="btn bg-teal btn-flat" target="_blank" href="{{ route('hospitals.create') }}"
                title="Rumah Sakit tidak ditemukan? tambahkan disini.">+</a>
        </span>
        @if ($isVisited)
            <span class="text-danger text-sm">
                Rumah Sakit sudah pernah dikunjungi oleh sales lain!
            </span>
        @endif
    </div>
</div>
