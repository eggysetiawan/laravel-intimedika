@extends('layouts.app',['title'=> 'Edit Customer'])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('modalities.index') }}">Daftar Customer</a></li>
    <li class="breadcrumb-item">Edit {{ $customer->name }}</li>
@endsection

@section('content')
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Customer {{ $customer->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="/customers/{{ $customer->slug }}/edit">
                        @method('patch')
                        @csrf
                        @include('customers.partials.form-control')
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
