@extends('layouts.app', ['title' => 'Edit Rumah Sakit'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('modalities.index') }}">Daftar Rumah Sakit</a></li>
    <li class="breadcrumb-item">Edit</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Rumah Sakit</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" method="post" action="{{ route('hospital.update', $hospital->slug) }}">
                        @csrf
                        @include('hospitals.partials.form-control')
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
