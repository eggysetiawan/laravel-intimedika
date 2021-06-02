<div class="d-flex row">
    <div class="col-md-12">
        <label for="qty.{{ $i }}">Qty #{{ $i }}</label>
        <div class="input-group mb-3">
            <input type="text" name="qty[]" id="price" class="form-control @error('qty.' . $i) is-invalid @enderror"
                value="{{ old('qty.' . ($i - 1)) }}">
            <div class="input-group-append">
                <span class="input-group-text">pcs/unit</span>
            </div>
        </div>

        @error('qty.' . $i)
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
