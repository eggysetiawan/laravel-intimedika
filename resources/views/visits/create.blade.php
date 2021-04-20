@extends('layouts.app', ['title' => 'Tambah Kunjungan'])


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">Kunjungan Harian</a></li>
    <li class="breadcrumb-item">Tambah Kunjungan Harian</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Tambah Kunjungan Harian</h3>
        </div>

        <form role="form" method="post" action="{{ route('visits.store') }}" novalidate enctype="multipart/form-data">
            @csrf
            @include('visits.partials.add-form-control', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection

@section('script')
    @include('customers.partials._select-customer')
@endsection
