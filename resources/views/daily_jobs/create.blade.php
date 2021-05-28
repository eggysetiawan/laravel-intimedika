@extends('layouts.app', ['title'=>'Laporan Harian'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('daily_jobs.index') }}">Daftar Laporan</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Buat Laporan Harian</h3>
        </div>
        <form method="POST" action="{{ route('daily_jobs.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <livewire:daily-jobs.create />
        </form>
    </x-card>
@endsection
