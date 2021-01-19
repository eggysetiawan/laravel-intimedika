@extends('layouts.app', ['title' => 'Tambah Rumah Sakit'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/hospitals">Daftar Rumah Sakit</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Rumah Sakit</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" method="post" action="{{ route('hospitals.store') }}">
                        @csrf
                        @include('hospitals.partials.form-control', ['submit' => 'Create'])
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
