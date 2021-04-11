<div class="d-flex justify-content-start btn-group">
    @isset(auth()->user()->two_factor_code)
        <button type="submit" name="approval" value="2" class="btn btn-danger px-4">
            Reject penawaran ini.
        </button>
        <a href="{{ route('verify.resend', $offer->slug) }}" class="btn btn-warning px-4">
            Resend OTP
        </a>
    @else
        <a href="{{ route('verify.send', $offer->slug) }}" class="btn btn-primary px-4">
            Send OTP
        </a>
    @endisset
</div>
