<div class="card-body">
    <div class="form-group">
        <label for="name">Customer</label>
        <select name="customer" id="customer" class="form-control select2">
            <option selected disabled>Pilih Customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
        @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="request">Permintaan</label>
        <textarea name="request" id="request" class="form-control @error('request') is-invalid @enderror" cols="30"
            rows="4" placeholder="Tuliskan Hasil Kunjungan Harian">{{ old('request') ?? $visit->request }}</textarea>
        @error('request')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="result">Hasil Kunjungan</label>
        <textarea name="result" id="result" class="form-control @error('result') is-invalid @enderror" cols="30"
            rows="10" placeholder="Tuliskan Hasil Kunjungan Harian">{{ old('result') ?? $visit->result }}</textarea>
        @error('result')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submit ?? 'Update' }}</button>
</div>
