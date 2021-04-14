<div class="d-flex justify-content-center btn-group">
    @isset(auth()->user()->two_factor_code)
        <div class="text-center mt-1">
            <button type="submit" name="approval" value="2" class="btn bg-danger form-control mb-3">
                Reject.
            </button>
            <span class="d-block mobile-text">Didn't receive the code?</span><a href="{{ route('verify.resend') }}"
                class="font-weight-bold text-orange cursor">Resend</a>
        </div>
    @else
        <a href="{{ route('verify.send') }}" class="btn bg-teal px-4">
            Send OTP
        </a>
    @endisset
</div>

{{-- add comment --}}
