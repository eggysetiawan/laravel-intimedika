@extends('layouts.app' ,['title' => 'Buat Kunjungan Harian'])

@section('breadcrumb')
    @if (!request()->segment(2))
        <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">Kunjungan Harian</a></li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('visitplan.index') }}">Rencana Kunjungan</a></li>
    @endif
    <li class="breadcrumb-item">Buat</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">{{ $cardHeader ?? 'Buat Kunjungan Baru' }}</h3>
        </div>

        <form role="form" method="post" action="{{ route('visitadd.store') }}" enctype="multipart/form-data">
            @csrf
            <livewire:visits.create />
        </form>
    </x-card>
@endsection

@section('script')
    <x-script-hospital />
    <x-script-user />
    <x-script-hospital-blade />
@endsection
