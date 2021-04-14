@extends('layouts.app', ['title'=> 'Verify',
'caption'=> ''])


@section('content')

    @include('verify.partials.otp')

    <div class="d-flex justify-content-center align-items-center container">
        <div class="card py-5 px-3">
            <form method="POST" action="{{ $route }}">
                @include('verify.partials._form-control')
                @include('verify.partials._button-approve')

            </form>
        </div>
    </div>

@endsection
