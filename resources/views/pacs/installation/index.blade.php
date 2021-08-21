@extends('layouts.app', ['title'=> 'Instalasi Intiwid',
'caption'=> 'Instalasi PACS'])

@section('breadcrumb')
    <li class="breadcrumb-item active">Daftar Instalasi</li>
    {{-- <li class="breadcrumb-item">Slug/Name Here</li> --}}
@endsection
@section('content')
    <div class="col-md-12">
        @unlessrole('director')
        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <x-button-create href="{{ route('pacs_installations.create') }}">Buat Instalasi</x-button-create>
            </div>
        </div>
        @endunlessrole
    </div>

    <div class="d-flex justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $installation->name ?? 'Table Instalasi' }}</h3>
                    <div class="card-body table-responsive">
                        <form action="{{ route('search.pacs_installations') }}" method="GET"
                            class="form-inline float-right">
                            <div class="row justify-content-end ">
                                <div class="form-groupcol-md-4">
                                    <select name="hospital" id="hospital" class="form-control select2">
                                        <option selected disabled>Cari Rumah Sakit</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->slug }}">
                                                {{ $hospital->name . ' - ' . $hospital->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @if (request('hospital'))
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-success ml-2">
                                            Search
                                        </button>
                                        <a href="{{ route('pacs_installations.index') }}"
                                            class="btn btn-warning">Reset</a>
                                    </div>
                                @else
                                    <button type="submit" class="btn btn-success ml-2">
                                        Search
                                    </button>
                                @endif

                            </div>
                        </form>
                        {!! $dataTable->table(['class' => 'table table-centered table-striped dt-responsive nowrap w-100', 'id' => 'pacsinstallation-table']) !!}

                    </div>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card -->
        </div>


    </div>
@endsection
@section('script')
    {!! $dataTable->scripts() !!}
@endsection
