@method('patch')
@csrf

<h5 class="m-0">Email address verification</h5><span class="mobile-text">
    @empty(auth()->user()->two_factor_code)
        We will send the verification code to
    @else
        Enter the code we just send on
        your
        email address
    @endempty
    <b class="text-orange">{{ auth()->user()->two_factor_code }}</b></span>
<div class="mt-5 mb-3">
    @if (auth()->user()->two_factor_code)
        <input type="text" name="two_factor_code" class="form-control" autofocus="" placeholder="Enter 4-digit code"
            maxlength="4" style="text-align: center" autocomplete="off">
    @endif
</div>
