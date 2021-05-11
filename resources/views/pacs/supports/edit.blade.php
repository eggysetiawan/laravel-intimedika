@extends('layouts.app', ['title'=>'Edit Troubleshooting'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pacs_supports.index') }}">Daftar Support PACS</a></li>
    <li class="breadcrumb-item">{{ $support->slug }}</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Edit Troubleshooting Intiwid</h3>
        </div>
        <form method="POST" action="{{ route('pacs_supports.update', $support->slug) }}">
            @csrf
            @method('patch')
            @include('pacs.supports.partials._form-control', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection
