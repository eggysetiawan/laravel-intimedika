@extends('layouts.app', ['title'=> 'Perjalanan Dinas',
'caption'=> 'Perjalanan Dinas'])

@section('breadcrumb')
    <li class="breadcrumb-item active">Perjalanan Dinas</li>
    {{-- <li class="breadcrumb-item">Slug/Name Here</li> --}}
@endsection
@section('content')
    <div class="col-md-12">
        @unlessrole('director')
        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <x-button-create href="{{ route('advances.create') }}">Buat Advance</x-button-create>
            </div>
        </div>
        @endunlessrole
    </div>

    <div class="d-flex justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive ">
                    {!! $dataTable->table([
    'class' => 'table table-centered table-striped dt-responsive
                    nowrap w-100',
    'id' => 'advance-table',
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
