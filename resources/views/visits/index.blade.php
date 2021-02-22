@extends('layouts.app',[
'title' => 'Kunjungan Harian',
'caption'=> 'Kunjungan Harian'
])

@section('breadcrumb')
    @isset($customer)
        <li class="breadcrumb-item"><a href="{{ route('visits') }}">Kunjungan Harian</a></li>
        <li class="breadcrumb-item">{{ $customer->name }}</li>
    @else
        <li class="breadcrumb-item">Kunjungan Harian</li>
    @endisset
@endsection

@section('content')

    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                @can('visits')
                    <x-button-create href="{{ route('visits.add') }}">Kunjungan Baru</x-button-create>
                    <a href="{{ route('visits.create') }}" class="btn btn-secondary btn-sm">Tambah Kunjungan</a>

                    @can('restore')
                        @if (request()->segment(2) == 'trash')
                            <a href="{{ route('visits.index') }}" class="btn btn-primary btn-sm"><i
                                    class="fas fa-table nav-icon"></i> Semua Kunjungan</a>
                        @else
                            <a href="{{ route('visits.trash') }}" class="btn btn-warning btn-sm"><i
                                    class="fas fa-recycle nav-icon"></i>Restore</a>
                        @endif
                    @endcan
                @endcan
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $tableHeader ?? 'Table Kunjungan' }}</h3>

                    <div class="card-tools">
                        <form action="{{ route('search.visits') }}" method="GET">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="query" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body table-responsive ">
                    {!! $dataTable->table([
                    'class' => 'table table-centered table-striped dt-responsive
                    nowrap w-100',
                    'id' => 'visit-table',
                    ]) !!}
                </div>
                <!-- /.card-header -->

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>




@endsection
@section('script')
    {!! $dataTable->scripts() !!}
@endsection
