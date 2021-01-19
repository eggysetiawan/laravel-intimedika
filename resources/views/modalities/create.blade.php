@extends('layouts.app',['title'=> 'Tambah Alat'])


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('modalities.index') }}">Daftar Alat Kesehatan</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <div class="container">

        <div class="d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Modality</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" method="post" action="{{ route('modalities.store') }}">
                        @csrf
                        @include('modalities.partials.form-control', ['submit' => 'Submit'])
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
