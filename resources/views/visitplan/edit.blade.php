@extends('layouts.app' ,['title' => 'Edit Rencana Kunjungan Harian'])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('visitplan.index') }}">Rencana Kunjungan</a></li>
    <li class="breadcrumb-item">Edit</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">{{ $cardHeader ?? 'Buat Kunjungan Baru' }}</h3>
        </div>

        <form role="form" method="post" action="{{ route('visitplan.update', $visit->slug) }}"
            enctype="multipart/form-data">
            @method('patch')
            @csrf
            @include('visits.partials.form-control2', ['submit' => 'Update'])
        </form>
    </x-card>
@endsection
