<div class="form-group">
    <label for="date">Tanggal Rencana Kunjungan</label>
    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
        placeholder="Masukan Nama" value="{{ old('date') ?? $visitplan->date }}" min="{{ date('Y-m-d') }}">
    @error('date')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="description">Keterangan Rencana Kunjungan</label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
        cols="30" rows="4"
        placeholder="Berikan keterangan rencana kunjungan..">{{ old('description') ?? $visitplan->description }}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
