@extends('layouts.app', ['title'=> 'Verify',
'caption'=> 'Verify your credential.'])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/visits">Kunjungan Harian</a></li>
    <li class="breadcrumb-item">Slug/Name Here</li>
@endsection
@section('content')
    <x-card>
        <div class="card-header">
            Two Factor Verification
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('approval.all-offers', $offer->slug) }}">
                @method('patch')
                @csrf

                @include('verify.partials._form-control')
                @include('verify.partials._button-reject')
            </form>
        </div>
    </x-card>

@endsection
