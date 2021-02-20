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
                    <h3 class="card-title">{{ $tableHeader ?? 'Semua Penawaran' }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                @if (request()->segment(1) == 'offers' && request()->segment(2) == 'complete')
                    @include('offers.partials.filter')
                @elseif(request()->segment(1) == 'offers' && !request()->segment(2))
                    @include('offers.partials.filter')
                @endif
                {{-- filter --}}

                <div class="card-body table-responsive ">
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
