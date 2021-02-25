@extends('layouts.app' ,['title' => 'Buat Kunjungan Harian'])

@section('breadcrumb')
    @if (!request()->segment(2))
        <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">Kunjungan Harian</a></li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('visits.plan') }}">Rencana Kunjungan</a></li>
    @endif
    <li class="breadcrumb-item">Buat</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">{{ $cardHeader ?? 'Buat Kunjungan Baru' }}</h3>
        </div>

        <form role="form" method="post" action="{{ route('visits.addStore') }}" enctype="multipart/form-data">
            @csrf
            @include('visits.partials.form-control2', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection
