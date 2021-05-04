@extends('layouts.app', ['title'=> 'Alat kesehatan',
'caption'=> 'Daftar Modalitas'])

@section('breadcrumb')
    <li class="breadcrumb-item">Daftar Modality</li>
    {{-- <li class="breadcrumb-item">Slug/Name Here</li> --}}
@endsection
@section('content')
    <div class="col-md-12">
        @unlessrole('director')
        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <x-button-create href="{{ route('pacs_supports.create') }}">Buat Support</x-button-create>
            </div>
        </div>
        @endunlessrole
    </div>

    <div class="d-flex justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $modalities->name ?? 'Table Modality' }}</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive ">
                    {!! $dataTable->table([
    'class' => 'table table-centered table-striped dt-responsive
                    nowrap w-100',
    'id' => 'pacssupport-table',
]) !!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


    </div>
@endsection
@section('script')
    {!! $dataTable->scripts() !!}
@endsection
