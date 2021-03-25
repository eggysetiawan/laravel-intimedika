@extends('layouts.app', ['title' => 'Beranda',])

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            Ini adalah halaman Dashboard Intimedika Puspa Indah Portal.
        </div>
        @if (auth()
            ->user()
            ->isAdmin())
            @empty(auth()->user()->pin)
                <div class="d-flex justify-content-center">
                    <div class="form-group">
                        <a href="{{ route('pins.create') }}" class="btn btn-success form-control">Setup Pin Anda disini</a>
                    </div>
                </div>
            @endempty
        @endif

    </div>
@endsection
