@extends('layouts.app', ['title'=>'Penawaran'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Daftar Penawaran</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Buat Penawaran</h3>
        </div>
        <form method="POST" action="{{ route('offers.store') }}">
            @csrf
            @include('offers.partials.form-control', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection

@section('script')
    @include('customers.partials._select-customer')
@endsection
