@extends('layouts.app', ['title' => 'Edit Rumah Sakit'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('hospitals.index') }}">Daftar Rumah Sakit</a></li>
    <li class="breadcrumb-item">Edit</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Edit Rumah Sakit</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form role="form" method="post" action="{{ route('hospitals.update', $hospital->slug) }}">
            @method('patch')
            @csrf
            @include('hospitals.partials.form-control')
        </form>
        </div>
    </x-card>

@endsection
