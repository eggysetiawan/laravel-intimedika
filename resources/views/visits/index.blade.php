@extends('layouts.app',[
'title' => $caption ?? 'Kunjungan Harian',
'caption'=> $caption ?? 'Kunjungan Harian',
])

@section('breadcrumb')
    @isset($customer)
        <li class="breadcrumb-item"><a href="{{ route('visits') }}">Kunjungan Harian</a></li>
        <li class="breadcrumb-item">{{ $customer->name }}</li>
    @else
        @if (!request()->segment(2))
            <li class="breadcrumb-item">Kunjungan Harian</li>
        @else
            <li class="breadcrumb-item">Rencana Kunjungan</li>
        @endif
    @endisset
@endsection

@section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                @switch(request()->segment(1))
                    @case('visitplan')
                    <x-button-create href="{{ route('visitplan.create') }}">Buat Rencana Kunjungan</x-button-create>
                    @break
                    @default

                    <x-button-create href="{{ route('visitadd.create') }}">Kunjungan Baru</x-button-create>
                    <a href="{{ route('visits.create') }}" class="btn btn-secondary btn-sm"> Lanjutkan Kunjungan</a>

                    @can('restore')
                        @if (request()->segment(2) == 'trash')
                            <a href="{{ route('visits.index') }}" class="btn btn-primary btn-sm"><i
                                    class="fas fa-table nav-icon"></i> Semua Kunjungan</a>
                        @else
                            {{-- <a href="{{ route('visits.trash') }}" class="btn btn-warning btn-sm"><i
                                    class="fas fa-recycle nav-icon"></i>Restore</a> --}}
                        @endif
                    @endcan
                @endswitch

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $tableHeader ?? 'Table Kunjungan' }}</h3>


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
