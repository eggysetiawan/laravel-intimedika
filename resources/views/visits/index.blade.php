@extends('layouts.app',[
'title' => 'Kunjungan Harian',
'caption'=> 'Kunjungan Harian'
])

@section('breadcrumb')
    @isset($customer)
        <li class="breadcrumb-item"><a href="/visits">Kunjungan Harian</a></li>
        <li class="breadcrumb-item">{{ $customer->name }}</li>
    @else
        <li class="breadcrumb-item">Kunjungan Harian</li>
    @endisset
@endsection

@section('content')

    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group ">
                <a href="{{ route('visits.add') }}" class="btn bg-teal btn-sm">Kunjungan Baru</a>
                <a href="{{ route('visits.create') }}" class="btn btn-secondary btn-sm">Tambah Kunjungan</a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $customer->name ?? 'Table Kunjungan' }}</h3>

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

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Rumah Sakit</th>
                                <th>Nama</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Request</th>
                                <th>Hasil Kunjungan</th>
                                <th>Nama Sales</th>
                            </tr>
                        </thead>

                        @forelse($visits as $visit)

                            <tbody>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $visit->customer->hospitals->first()->name }}</td>
                                    <td>{{ $visit->customer->name }}</td>
                                    <td>{{ $visit->customer->mobile }}</td>
                                    <td>{{ $visit->customer->email }}</td>
                                    <td>{{ $visit->customer->role }}</td>
                                    <td>{{ $visit->request }}</td>
                                    <td>
                                        {{ Str::limit($visit->result, 50) }}
                                        <div><a href="{{ route('visits.show', $visit->slug, '...') }}">Read More</a></div>
                                    </td>
                                    <td>{{ $visit->author->name }}</td>
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
                            {{ $visits->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>




@endsection
