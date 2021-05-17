<div class="card-body">
    <x-testing-user></x-testing-user>
    <div class="form-group">
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control"
            value="{{ old('date') ?? date('Y-m-d', strtotime($dailyJob->date ?? now())) }}">
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $dailyJob->title }}"
            placeholder="Tuliskan judul laporan harian...">
    </div>

    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" rows="3" class="form-control"
            placeholder="Tuliskan deskripsi laporan harian">{{ old('description') ?? $dailyJob->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="files">Upload File</label>
        <input type="file" name="files" id="files" class="form-control-file">
    </div>

</div>

<div class="card-footer">
    <x-button-submit>Submit</x-button-submit>
</div>
