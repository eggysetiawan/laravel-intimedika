@extends('layouts.app', ['title'=> 'Verify',
'caption'=> 'Verify your credential.'])

@section('breadcrumb')
    <li class="breadcrumb-item">Approve semua penawaran.</li>
@endsection
@section('content')
    <x-card>
        <div class="card-header">
            Two Factor Verification
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('approval.all-offers') }}">
                @method('patch')
                @csrf

                @include('verify.partials._form-control')

                @include('verify.partials._button-approve')
            </form>
        </div>
    </x-card>

@endsection
