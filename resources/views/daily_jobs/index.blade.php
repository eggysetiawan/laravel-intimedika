@extends('layouts.app', ['title'=> 'Laporan Harian',
'caption'=> 'Laporan Harian'])

@section('breadcrumb')
    <li class="breadcrumb-item active">Laporan Harian</li>
    {{-- <li class="breadcrumb-item">Slug/Name Here</li> --}}
@endsection
@section('content')

    <div class="col-md-12 mb-2">
        <div class="d-flex justify-content-end">
            <div class="btn-group btn-group-sm">
                <a href="{{ route('daily_jobs.index') }}" class="btn bg-teal ">
                    <i class="fas fa-table nav-icon"></i> Table
                </a>
                <a href="{{ route('daily_jobs.timeline') }}" class="btn btn-secondary">
                    <i class="fas fa-align-justify nav-icon"></i></i> Timeline
                </a>
            </div>
        </div>
    </div>

    @unlessrole('director')
    @include('daily_jobs.partials._create-job')
    @endunlessrole

    <div class="d-flex justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Table Laporan Harian</h3>

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
    'id' => 'dailyjobs-table',
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
