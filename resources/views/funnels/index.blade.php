@extends('layouts.app', ['title'=> 'Funnel',
'caption'=> 'Funnel'])

@section('breadcrumb')
    <li class="breadcrumb-item">Funnel</li>

@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                <button type="button" class="btn bg-teal btn-sm" data-toggle="modal" data-target="#modal-funnel">
                    Buat Funnel
                </button>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-center">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $tableHeader ?? 'Sales Funnel' }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>


                <div class="card-body table-responsive ">
                    {!! $dataTable->table([
    'class' => 'table table-centered table-striped dt-responsive
                    nowrap w-100',
    'id' => 'funnel-table',
]) !!}
                </div>
            </div>

            <!-- /.card -->
        </div>



    </div>

    <div class="modal fade" id="modal-funnel">
        <div class="modal-dialog modal-sm">
            <form action="{{ route('funnels.create') }}" method="GET">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-teal">
                        <h4 class="modal-title">Buat Funnel</h4>
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
