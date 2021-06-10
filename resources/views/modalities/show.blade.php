@extends('layouts.app', ['title'=> $modality->name,
'caption'=> $modality->name])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('modalities.index') }}">Daftar Modality</a></li>
    <li class="breadcrumb-item">{{ Str::limit($modality->name, 20, '...') }}</li>
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('sampleModality/cr12x.png') }}" class="img-fluid" alt="Responsive image">
            </div>

            <div class="col-md-6">
                <div class="d-flex justify-content-start">
                    <h1>{{ $modality->brand }}</h1>
                </div>

                <hr style="margin: 0px;">
                <br>
                <div class="container px-2">
                    <div class="d-flex justify-content-between">
                        <p>Kategori :{{ $modality->category }}</p>
                        <p>Harga : @currency($modality->price)</p>
                    </div>
                </div>

                <pre class="wordwrap">{!! $modality->spec !!}</pre>

            </div>
        </div>

    </div>

@endsection
