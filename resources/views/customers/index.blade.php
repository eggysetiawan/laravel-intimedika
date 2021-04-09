@extends('layouts.app', ['title'=> 'Customer',
'caption'=> 'Daftar Customer'])

@section('breadcrumb')
    <li class="breadcrumb-item">Daftar Customer</li>
@endsection
@section('content')
    <div class="col-md-12">
        @unlessrole('director')
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                <x-button-create href="{{ route('customers.create') }}">Tambah Customer</x-button-create>
            </div>
        </div>
        @endunlessrole


    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $customer->name ?? 'Table Customer' }}</h3>

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
    'id' => 'customer-table',
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
