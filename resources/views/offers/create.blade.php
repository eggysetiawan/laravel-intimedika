@extends('layouts.app', ['title'=>'Penawaran'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Daftar Penawaran</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-teal">
                    <div class="card-header">
                        <h3 class="card-title">Buat Penawaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form method="POST" action="{{ route('offers.store') }}">
                        @csrf
                        @include('offers.partials.form-control', ['submit' => 'Create'])
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
