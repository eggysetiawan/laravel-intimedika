@extends('layouts.app',['title'=> 'Tambah Alat'])


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('modalities.index') }}">Daftar Alat Kesehatan</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Tambah Modality</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form role="form" method="post" action="{{ route('modalities.store') }}" novalidate>
            @csrf
            @include('modalities.partials.form-control', ['submit' => 'Submit'])
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#spec').summernote({
                placeholder: 'Spesifikasi Alat..',
                tabsize: 2,
            });
        });

    </script>
@endsection
