@extends('layouts.app', ['title'=>'Tambah Customer'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Daftar Customer</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-alert />
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Tambah Customer</h3>
        </div>
        <form role="form" method="post" action="{{ route('customers.store') }}" novalidate autocomplete="off">
            @csrf
            <livewire:customers.create />
        </form>
    </x-card>
@endsection

@section('script')
    <x-script-hospital />
    <x-script-user />
@endsection
