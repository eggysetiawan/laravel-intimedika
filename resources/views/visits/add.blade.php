@extends('layouts.app' ,['title' => 'Buat Kunjungan Harian'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">Kunjungan Baru</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Kunjungan Baru</h3>
        </div>

        <form role="form" method="post" action="{{ route('visits.addStore') }}" enctype="multipart/form-data">
            @csrf
            @include('visits.partials.form-control2', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection
