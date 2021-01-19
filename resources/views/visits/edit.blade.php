@extends('layouts.app', ['title' => 'Edit Kunjungan Harian',])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/visits">Kunjungan Harian</a></li>
    <li class="breadcrumb-item"><a href="/visits/{{ $visit->slug }}">{{ Str::limit($visit->slug, 15, '...') }}</a></li>
    <li class="breadcrumb-item">Edit Kunjungan</li>
@endsection

@section('content')
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Kunjungan {{ $visit->customer->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{ route('visits.edit', $visit->slug) }}">
                        @method('patch')
                        @csrf
                        @include('visits.partials.form-control')
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
