@extends('layouts.app', ['title'=>'Instalasi PACS'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pacs_installations.index') }}">Daftar Penawaran</a></li>
    <li class="breadcrumb-item">Buat Instalasi</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-teal">
                    <div class="card-header">
                        <h3 class="card-title">
                            <div class="d-flex">
                                Informasi lokasi instalasi & user
                            </div>
                        </h3>
                    </div>
                    <form method="POST" action="{{ route('pacs_installations.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pacs.installation.partials._form-control', ['submit' => 'Create'])
                    </form>
                </div>
            </div>



        </div>


    </div>

@endsection

@section('script')
    @include('hospitals.partials._select-hospital-script')
@endsection
