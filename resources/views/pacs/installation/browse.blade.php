@extends('layouts.app', ['title'=>'Upload File Instalasi Intiwid'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pacs_installations.index') }}">Instalasi Intiwid</a></li>
    <li class="breadcrumb-item">Upload Berkas</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Upload Berkas</h3>
        </div>
        <form method="POST" action="{{ route('pacs_installations.upload', $pacsInstallation->slug) }}"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                    <label for="files">Upload File</label>
                    <input type="file" name="files" multiple id="files" class="form-control-file">
                </div>
            </div>

            <div class="card-footer">
                <x-button-submit>Upload</x-button-submit>
            </div>
        </form>
    </x-card>
@endsection

@section('script')
    @include('customers.partials._select-customer')
@endsection
