@extends('layouts.app', ['title'=> 'Rumah Sakit',
'caption'=> 'Daftar Modalitas'])

@section('breadcrumb')
    <li class="breadcrumb-item">Daftar Rumah Sakit</li>
    {{-- <li class="breadcrumb-item">Slug/Name Here</li> --}}
@endsection
@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            <a href="{{ route('hospitals.create') }}" class="btn btn-primary mb-2 p-1"><i class="fa fa-plus"
                    aria-hidden="true"></i> Tambah Rumah Sakit</a>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $hospitals->name ?? 'Table Rumah Sakit' }}
                    </h3>

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
                    <table class="table table-hover text-nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th></th>
                            </tr>
                        </thead>
                        @forelse($hospitals as $hospital)

                            <tbody>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hospital->name }}</td>
                                    <td>{{ $hospital->phone }}</td>
                                    <td>{!! $hospital->address !!}</td>

                                    <td><a href="{{ route('hospitals.edit', $hospital->slug) }}"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <form action="{{ route('hospitals.delete', $hospital->slug) }}" class="d-inline"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin?')">Delete</button>
                                        </form>

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
                    <div class="d-flex justify-content-end mr-4">
                        <div>
                            {{ $hospitals->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


    </div>
@endsection
