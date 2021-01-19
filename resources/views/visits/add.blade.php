@extends('layouts.app' ,['title' => 'Buat Kunjungan Harian'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/visits">Kunjungan Baru</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kunjungan Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form role="form" method="post" action="/visits/addStore">
                        @csrf
                        @include('visits.partials.form-control2', ['submit' => 'Create'])
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
