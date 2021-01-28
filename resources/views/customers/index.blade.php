@extends('layouts.app', ['title'=> 'Customer',
'caption'=> 'Daftar Customer'])

@section('breadcrumb')
    <li class="breadcrumb-item">Daftar Customer</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                <a href="{{ route('customers.create') }}" class="btn bg-teal btn-sm">Tambah Customer</a>
            </div>
        </div>
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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Rumah Sakit/Perusahaan</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Kunjungan</th>
                                <th>Sales</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @forelse($customers as $customer)

                            <tbody>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->hospitals->first()->name ?? $customer->name }}</td>
                                    <td>{{ $customer->mobile }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->role }}</td>
                                    <td>
                                        <a
                                            href="{{ route('customers.show', $customer->slug) }}">{{ $customer->visits->count() }}</a>
                                    </td>
                                    <td>{{ $customer->author->name }}</td>
                                    <td>
                                        <a href="{{ route('customers.edit', $customer->slug) }}"
                                            class="badge bg-gradient-light px-1">edit</a>
                                    </td>

                                </tr>
                            </tbody>
                        @empty
                            <tbody>
                                <tr>
                                    <td cols="6">Tidak ada data.</td>
                                </tr>
                            </tbody>
                        @endforelse
                    </table>
                    {{-- agar ditengah = center , kanan = end, kiri = start
                    --}}


                </div>
                <!-- /.card-body -->
            </div>
            <div class="d-flex justify-content-center">
                {{ $customers->links() }}
            </div>

            <!-- /.card -->
        </div>

    </div>
@endsection
