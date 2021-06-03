<div class="form-group">
    <div class="d-flex justify-content-between">
        <label>No Penawaran</label>
        <label>Tanggal Penawaran</label>
    </div>

    <div class="row">

        <div class="col-md-6">
            <input type="number" name="queue" class="form-control @error('queue') is-invalid @enderror" id="queue"
                value="{{ old('queue') }}" placeholder="Nomor Penawaran" max="999">
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="date" name="date" id="datemask" class="form-control @error('date') is-invalid @enderror"
                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask
                    value="{{ old('date') ?? now()->format('Y-m-d') }}">
                @error('date')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <!-- /.input group -->
    </div>
</div>
