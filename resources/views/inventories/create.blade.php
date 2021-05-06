@extends('layouts.app', ['title'=>'Inventory'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('inventories.index') }}">Daftar Inventory</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Buat Inventory</h3>
        </div>
        <form method="POST" action="{{ route('inventories.store') }}">
            @csrf
            @include('inventories.partials._form-control', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection
