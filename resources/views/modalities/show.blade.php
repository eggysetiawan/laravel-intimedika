@extends('layouts.app', ['title'=> $modality->name,
'caption'=> $modality->name])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/modalities">Daftar Modality</a></li>
    <li class="breadcrumb-item">{{ Str::limit($modality->name, 20, '...') }}</li>
@endsection
@section('content')
    <div class="d-flex justify-content-start">
        <h1>{{ $modality->model }}</h1>
    </div>
    <small class="text-danger">
        <div class="container px-2">
            <div class="d-flex justify-content-between h3">
                {{ $modality->category }}
                <p>Harga : @currency($modality->price)</p>
            </div>
        </div>
    </small>

    <p>{{ $modality->spec }}</p>

@endsection
