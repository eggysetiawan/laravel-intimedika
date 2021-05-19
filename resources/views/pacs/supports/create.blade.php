@extends('layouts.app', ['title'=>'Troubleshooting PACS'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pacs_supports.index') }}">Daftar Support PACS</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Troubleshooting Intiwid</h3>
        </div>
        <form method="POST" action="{{ route('pacs_supports.store') }}">
            @csrf
            @include('pacs.supports.partials._form-control', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection

{{-- @section('script')
    @include('pacs.supports.partials._select-installation-script')
@endsection --}}
