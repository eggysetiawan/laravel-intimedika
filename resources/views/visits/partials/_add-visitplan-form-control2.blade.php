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
    <label for="area">Area</label>
    <input type="text" name="area" id="area" class="form-control @error('area') is-invalid @enderror"
        placeholder="Input area rencana kunjungan.." value="{{ old('area') ?? ($visitplan->area ?? '') }}">
    @error('area')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="territory">Ruangan/Bagian</label>
    <input type="text" name="territory" id="territory" class="form-control @error('territory') is-invalid @enderror"
        placeholder="Input ruangan/bagian.." value="{{ old('territory') ?? $visitplan->territory }}">
    @error('territory')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>


<div class="form-group">
    <label for="description">Aktifitas Rencana Kunjungan</label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
        cols="30" rows="4"
        placeholder="Berikan keterangan rencana kunjungan..">{{ old('description') ?? $visitplan->description }}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
