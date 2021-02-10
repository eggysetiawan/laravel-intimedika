@extends('layouts.app', ['title'=> 'Penawaran',
'caption'=> 'Penawaran'])

@section('breadcrumb')
    <li class="breadcrumb-item">Penawaran</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                <button type="button" class="btn bg-teal btn-sm" data-toggle="modal" data-target="#modal-sm">
                    Buat Penawaran
                </button>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $offers->name ?? 'Table Penawaran' }}</h3>
                </div>

                @if (request('from') && request('to'))
                    <div class="d-flex justify-content-center h4">
                        <span style="font-weight: bold">{{ request('from') }}</span>&nbsp; s/d &nbsp;
                        <span style="font-weight: bold">{{ request('to') }}</span>
                        <span class="text-danger text-sm"><a href="{{ route('offers.index') }}">Reset</a></span>
                    </div>
                @endif

                <!-- /.card-header -->
                <div class="d-flex justify-content-end mt-3 mr-3">
                    <form action="{{ route('offers.filter') }}" method="GET">
                        <span class="input-group justify-content-lg-end">
                            <div class="col-md-4">
                                <label for="from">From</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-teal"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="search" value="{{ old('from') }}" name="from" id="datemask"
                                        class="form-control @error('date') is-invalid @enderror"
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex justify-content-start">
                                    <label for="to">To</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-teal"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="search" name="to" value="{{ old('to') }}" id="datemask"
                                        class="form-control @error('date') is-invalid @enderror"
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                    <span class="input-group-append">
                                        <button type="submit" class="btn bg-teal btn-sm">Filter</button>
                                    </span>
                                </div>
                            </div>
                        </span>
                    </form>
                    @if (request()->segment(1) == 'hospitals-filter')
                        <a href="{{ route('hospitals.index') }}" class="btn btn-warning btn-sm"
                            style="margin-top:32px;">Reset</a>
                    @endif
                </div>
                <div class="card-body table-responsive ">
                    {!! $dataTable->table(['class' => 'table table-centered table-striped dt-responsive nowrap w-100', 'id'
                    => 'offer-table']) !!}
                    {{-- <table class="table table-hover text-nowrap  table-responsive-sm"
                        id="offers">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Penawaran</th>
                                <th>Customer</th>
                                <th>Dana</th>
                                <th>Sales</th>
                            </tr>
                        </thead>

                    </table> --}}


                </div>
                <!-- /.card-body -->
            </div>
            {{-- <div class="d-flex justify-content-center">
                {{ $offers->links() }}
            </div> --}}

            <!-- /.card -->
        </div>



    </div>

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
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
                        <button type="submit" class="btn bg-red">Submit</button>
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
