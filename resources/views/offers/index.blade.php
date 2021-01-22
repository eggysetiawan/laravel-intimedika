@extends('layouts.app', ['title'=> 'Penawaran',
'caption'=> 'Penawaran'])

@section('breadcrumb')
    <li class="breadcrumb-item">Penawaran</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                <a href="{{ route('offers.create') }}" class="btn bg-teal btn-sm">Buat Penawaran</a>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $offers->name ?? 'Table Penawaran' }}</h3>

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

                                <th>Action</th>
                            </tr>
                        </thead>
                        @forelse($offers as $offer)

                            <tbody>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>


                                    <td>
                                        {{-- <a href="{{ route('offers.edit', $offer->slug) }}"
                                            class="badge bg-gradient-light px-1">edit</a> --}}
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
                {{ $offers->links() }}
            </div>

            <!-- /.card -->
        </div>

    </div>
@endsection
