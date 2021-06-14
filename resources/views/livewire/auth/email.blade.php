<div>
    <div class="input-group mb-3">
        <input placeholder="email" id="email" type="email"
            class="form-control  @error('email') is-invalid @else is-valid @enderror" name="email" autofocus
            wire:model.debounce.500ms="email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="row">

        <!-- /.col -->
        <div class="col-12">
            <button type="submit" name="submit" value="magic-link" class="btn bg-orange btn-block" @if ($errors->any()) disabled @endif>Send
                Login Email</button>
        </div>
        <!-- /.col -->
    </div>

</div>
