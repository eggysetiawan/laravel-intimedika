@extends('layouts.app', ['title'=> 'Target',
'caption'=> 'Target'])

@section('breadcrumb')
    <li class="breadcrumb-item">Target</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                <x-button-create href="{{ route('targets.create') }}">Buat Target</x-button-create>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $target->author->name ?? 'Table Target Sales' }}</h3>

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
    'id' => 'target-table',
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
