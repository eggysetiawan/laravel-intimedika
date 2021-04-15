@extends('layouts.app' ,['title' => 'Buat Kunjungan Harian'])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('visitplan.index') }}">Rencana Kunjungan</a></li>
    <li class="breadcrumb-item">Buat</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">{{ $cardHeader ?? 'Buat Kunjungan Baru' }}</h3>
        </div>

        <form role="form" method="post" action="{{ route('visitplan.store') }}" enctype="multipart/form-data">
            @csrf
            @include('visits.partials.form-control2', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection

@section('script')
    @include('hospitals.partials._select-hospital-script')
@endsection
