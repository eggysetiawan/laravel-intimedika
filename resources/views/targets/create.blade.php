@extends('layouts.app', ['title' => 'Target Sales'])


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('targets.index') }}">Daftar Target</a></li>
    <li class="breadcrumb-item">Buat Target</li>
@endsection

@section('content')
<x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Buat Target</h3>
        </div>

        <form role="form" method="post" action="{{ route('targets.store') }}" novalidate enctype="multipart/form-data">
            @csrf
            @include('targets.partials._form-control', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection
