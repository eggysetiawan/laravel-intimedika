@extends('layouts.app', ['title'=>'Tambah Customer'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Daftar Customer</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-teal">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Customer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" method="post" action="{{ route('customers.store') }}" novalidate>
                        @csrf
                        @include('customers.partials.form-control', ['submit' => 'Create'])
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
