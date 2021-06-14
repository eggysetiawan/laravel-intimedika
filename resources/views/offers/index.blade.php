@extends('layouts.app', ['title'=> 'Penawaran',
'caption'=> 'Penawaran'])

@section('breadcrumb')
    @if (request()->segment(2) == 'trash')
        <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Penawaran</a></li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Penawaran</a></li>
    @endif
@endsection
@section('content')
    @hasrole('superadmin|sales')
    <div class="d-flex justify-content-end mb-4">
        <div class="btn-group">
            <button type="button" class="btn bg-teal btn-sm" data-toggle="modal" data-target="#modal-sm">
                Buat Penawaran
            </button>
            @if (request()->segment(2) == 'trash')
                <a href="{{ route('offers.index') }}" class="btn btn-primary btn-sm"><i class="fas fa-table nav-icon"></i>
                    Semua Penawaran</a>
            @else
                @can('openworld')
                    <a href="{{ route('offers.trash') }}" class="btn btn-warning btn-sm"><i
                            class="fas fa-recycle nav-icon"></i> Recyle Bin</a>
                @endcan
            @endif
        </div>
    </div>
    @endhasrole


    <div class="d-flex justify-content-center">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $tableHeader ?? 'Semua Penawaran' }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>


                @include('offers.partials.reset')

                @if (request()->segment(1) == 'offers' && request()->segment(2) == 'completed')
                    @include('offers.partials.filter')
                @elseif(request()->segment(1) == 'offers' && request()->segment(2)=="filter")
                    @include('offers.partials.filter')
                @elseif(request()->segment(1) == "offers" && !request()->segment(2))
                    @include('offers.partials.filter')
                @endif
                @if ($approval > 0 && request()->segment(1) == 'offers')
                    @include('offers.partials.approval')
                @elseif($approval > 0 && request()->segment(1) == 'progresses')
                    @include('offers.partials.approval')
                @endif


                <div class="card-body table-responsive">
                    @if (request()->segment(2) == 'completed')
                        @if ($completedCount > 0)
                            <a href="{{ route('excel.offer') }}" class="btn btn-success btn-sm mb-2"><i
                                    class="far fa-file-excel"></i>
                                Excel
                            </a>
                        @endif
                    @endif
                    {!! $dataTable->table([
    'class' => 'table table-centered table-striped dt-responsive
                    nowrap w-100',
    'id' => 'offer-table',
]) !!}
                </div>
            </div>

            <!-- /.card -->
        </div>



    </div>

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <form action="{{ route('offers.create') }}" method="GET">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-teal">
                        <h4 class="modal-title">Buat Penawaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="count">Masukan Jumlah Alat</label>
                            <select name="count" id="count" class="form-control">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }} Alat</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <x-button-submit>Submit</x-button-submit>
                    </div>

                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>


@endsection


@section('script')
    {!! $dataTable->scripts() !!}
@endsection
