<p class="text-muted">
    You have received an email which contains two factor approval code.
    If you haven't received it, press <a href="{{ route('verify.resend', $offer->slug) }}">here</a>.
</p>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="fa fa-lock"></i>
        </span>
    </div>
    <input name="two_factor_code" type="text"
        class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" required autofocus
        placeholder="4-digit Two Factor Code" maxlength="4">
    @if ($errors->has('two_factor_code'))
        <div class="invalid-feedback">
            {{ $errors->first('two_factor_code') }}
        </div>
    @endif
</div>
