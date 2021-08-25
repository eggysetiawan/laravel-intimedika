    <div class="card-body">
        <x-testing-user></x-testing-user>
        <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" name="date" id="date"
                class="form-control @error('date') is-invalid @else is-valid @enderror"
                wire:model.debounce.500ms="date">
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $dailyJob->title }}"
                placeholder="Tuliskan judul laporan harian...">
        </div> --}}

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                class="form-control @error('description') is-invalid @else is-valid @enderror"
                placeholder="Tuliskan deskripsi laporan harian" wire:model.debounce.500ms="description"></textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">

            <label for="img">Upload File (optional)</label>
            <input type="file" name="img" id="img"
                class="form-control-file @error('img') is-invalid @else is-valid @enderror"
                wire:model.debounce.500ms="img" accept=".zip,.rar,.pdf">
            <div wire:loading wire:target="img">
                <x-loading_file class="mt-2" />
                <div><small>Processing file..</small></div>
            </div>
            @error('img')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- testestsetse --}}
    </div>

    {{-- <div class="card-footer">
        <x-button-submit wire:loading.attr="disabled">Submit</x-button-submit>
    </div> --}}
    <div class="card-footer">
        <button type="submit" class="btn bg-teal" @if ($errors->any()) disabled @endif wire:loading.attr="disabled">{{$submit ?? "Submit"}}</button>
    </div>
