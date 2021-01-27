@extends('layouts.app', ['title'=> 'Penawaran',
'caption'=> 'Penawaran'])

@section('breadcrumb')
    <li class="breadcrumb-item">Penawaran</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-4">
            <div class="btn-group">
                <button type="button" class="btn bg-maroon btn-sm" data-toggle="modal" data-target="#modal-sm">
                    Penawaran RS
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-toggle="modal" data-target="#modal-sm2">
                    Penawaran PT
                </button>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $offers->name ?? 'Table Penawaran' }}</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body table-responsive ">
                    <table class="table table-hover text-nowrap  table-responsive-sm" id="offers">
                    <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Penawaran</th>
                                <th>Customer</th>
                                <th>Dana</th>
                                <th>Sales</th>
                            </tr>
                        </thead>

                    </table>


                </div>
                <!-- /.card-body -->
            </div>
            {{-- <div class="d-flex justify-content-center">
                {{ $offers->links() }}
            </div> --}}

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
                        <button type="submit" class="btn bg-teal">Submit</button>
                    </div>

                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>

    <div class="modal fade" id="modal-sm2">
        <div class="modal-dialog modal-sm">
            <form action="{{ route('offers.create-cust') }}" method="POST">
                @csrf

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
                        <button type="submit" class="btn bg-teal">Submit</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#offers').DataTable({
                processing: true,
                serverSide: true,
                "autoWidth": false,
                "responsive": true,
                "info": true,
                ajax: {
                    url: "{{ route('offers.index') }}",
                    type: "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'offer_no',
                        name: 'offer_no'
                    },

                    {
                        data: 'customer.name',
                        name: 'customer.name'
                    },
                    {
                        data: 'budget',
                        name: 'budget',
                    },
                    {
                        data: 'author.name',
                        name: 'author.name'
                    },
                ],
                order: [
                    [1, 'asc']
                ]
            });
        });

    </script>
@endsection
