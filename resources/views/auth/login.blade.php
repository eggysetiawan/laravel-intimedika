<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IPI Portal | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('css/pre.css') }}">
</head>

<body class="hold-transition login-page accent-orange">
    {{-- Preloader Content --}}
    @include('layouts.preloader')
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="1000" data-aos-duration="500">
            <a href="{{ route('home') }}" class=""><img src="{{ asset('image/logoipi.png') }}" width="400"
                    class="img-fluid" alt="Logo IPI">
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="login-box" data-aos="fade-left">
                    <!-- /.login-logo -->
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="{{ route('login') }}" method="post" novalidate>
                        @csrf
                        <div class="input-group mb-3">
                            <input placeholder="Username" id="username" type="text"
                                class="form-control  @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username') }}" autocomplete="username" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input placeholder="Password" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="#!" onclick="myFunction()"><span class="fas fa-eye"></span></a>
                                </div>
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn bg-orange btn-block text-white">Sign
                                    In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <a href="{{ route('login.email') }}" class="btn btn-block btn-secondary"><i
                                class="fas fa-at mr-2"></i>
                            {{ __('Sign in using Email') }}</a>
                    </div>

                    <!-- /.social-auth-links -->

                    <p class="mb-1">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </p>
                    {{-- <p class="mb-0">
                                @if (Route::has('register'))
                                    <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                            </p> --}}
                    <!-- /.login-card-body -->
                </div>
            </div>
            <div class="col-md-4 pt-0">
                <div class="hide-log-animate">
                    @include('layouts.animations.login')
                </div>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script src="{{ asset('js/pre.js') }}"></script>

    <script>
        AOS.init();
      </script>
</body>

</html>
