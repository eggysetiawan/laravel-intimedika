@extends('layouts.app', ['title' => 'Update Rencana Kunjungan',])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">Kunjungan Harian</a></li>
    {{-- <li class="breadcrumb-item"><a href="/visits/{{ $visit->slug }}">{{ Str::limit($visit->slug, 15, '...') }}</a></li> --}}
    <li class="breadcrumb-item">Update Kunjungan</li>
@endsection

@section('content')
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Kunjungan {{$visit->customer->hospitals->first()->name ?? $visit->customer->name  }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{ route('visits.edit', $visit->slug) }}" novalidate>
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
