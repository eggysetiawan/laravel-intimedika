@extends('layouts.app', ['title'=> 'Rumah Sakit',
'caption'=> 'Daftar Modalitas'])

@section('breadcrumb')
    <li class="breadcrumb-item">Daftar Rumah Sakit</li>
    {{-- <li class="breadcrumb-item">Slug/Name Here</li> --}}
@endsection
@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            <a href="{{ route('hospitals.create') }}" class="btn bg-teal mb-2 p-1"><i class="fa fa-plus"
                    aria-hidden="true"></i> Tambah Rumah Sakit</a>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $hospitals->name ?? 'Table Rumah Sakit' }}
                    </h3>
                    {{-- spt nya route tombolnya ada yg typo mas, di action.blade.php
                    --}}

                </div>
                <!-- /.card-header -->
                <form action="{{ route('hospitals.filter') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="d-flex justify-content-end mt-3">
                        <span class="input-group justify-content-lg-end">
                            <div class="col-md-2">
                                <label for="from">From</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="search" name="from" id="datemask"
                                        class="form-control @error('date') is-invalid @enderror"
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex justify-content-end">
                                    <label for="to">To</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="search" name="to" id="datemask"
                                        class="form-control @error('date') is-invalid @enderror"
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-danger btn-sm">Filter</button>
                                    </span>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </span>





                    </div>
                </form>
                <div class="card-body table-responsive">
                    {!! $dataTable->table(['class' => 'table table-centered table-striped dt-responsive nowrap w-100', 'id'
                    => 'hospital-table']) !!}
                    {{-- <table class="table table-hover text-nowrap" style="width: 100%;"
                        id="hospitals">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table> --}}
                    {{-- agar ditengah = center , kanan = end, kiri = start
                    --}}

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


    </div>
@endsection

@section('script')
    {!! $dataTable->scripts() !!}
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#hospitals').DataTable({
                processing: true,
                serverSide: true,
                "autoWidth": false,
                "responsive": true,
                ajax: {
                    url: "{{ route('hospitals.index') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address',
                    },
                    {
                        data: 'slug',
                        "searchable": false,
                    },
                ]
            });
        });

    </script> --}}
@endsection
