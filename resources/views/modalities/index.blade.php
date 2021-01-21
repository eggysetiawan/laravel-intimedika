@extends('layouts.app', ['title'=> 'Alat kesehatan',
'caption'=> 'Daftar Modalitas'])

@section('breadcrumb')
    <li class="breadcrumb-item">Daftar Modality</li>
    {{-- <li class="breadcrumb-item">Slug/Name Here</li> --}}
@endsection
@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            <a href="{{ route('modalities.create') }}" class="btn bg-teal mb-2 px-1"><i class="fa fa-plus"
                    aria-hidden="true"></i> Tambah Alat</a>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $modalities->name ?? 'Table Modality' }}</h3>

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
                                <th>Model</th>
                                <th>Merk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Referensi</th>
                                <th>Spesifikasi</th>
                                <th></th>
                            </tr>
                        </thead>
                        @forelse($modalities as $modality)

                            <tbody>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $modality->name }}</td>
                                    <td>{{ $modality->model }}</td>
                                    <td>{{ $modality->brand }}</td>
                                    <td>@currency($modality->price)</td>
                                    <td>{{ $modality->stock }}</td>
                                    <td>{{ $modality->reference }}</td>
                                    <td>
                                        {{ Str::limit($modality->spec, 50) }}
                                        <div><a href="{{ route('modalities.show', $modality->slug) }}">Read More..</a></div>
                                    </td>
                                    <td><a href="{{ route('modalities.edit', $modality->slug) }}"
                                            class="btn btn-success btn-sm">Edit</a>
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
                            {{ $modalities->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


    </div>
@endsection
