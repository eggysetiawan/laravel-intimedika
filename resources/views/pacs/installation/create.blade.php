@extends('layouts.app')
@section('title', 'Instalasi PACSC')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pacs_installations.index') }}">Instalasi PACS</a></li>
    <li class="breadcrumb-item">Buat Instalasi PACS</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kunjungan Harian</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" method="post" action="/visits/store">
                        @csrf
                        @include('visits.partials.add-form-control', ['submit' => 'Create'])
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
