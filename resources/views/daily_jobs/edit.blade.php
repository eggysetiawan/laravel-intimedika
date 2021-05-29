@extends('layouts.app', ['title'=>'Edit Laporan Harian'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('daily_jobs.index') }}">Daftar Laporan</a></li>
    <li class="breadcrumb-item">{{ $dailyJob->slug }}</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Edit Laporan Harian</h3>
        </div>
        <form method="POST" action="{{ route('daily_jobs.update', $dailyJob->slug) }}">
            @csrf
            @method('patch')
            <livewire:daily-jobs.edit :key="$dailyJob->id" :dailyJob="$dailyJob" />

        </form>
    </x-card>
@endsection
