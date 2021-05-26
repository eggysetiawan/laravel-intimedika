@extends('layouts.app', ['title' => 'Tambah Rumah Sakit'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/hospitals">Daftar Rumah Sakit</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Tambah Rumah Sakit</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form role="form" method="post" action="{{ route('hospitals.store') }}" autocomplete="off">
            @csrf
            @include('hospitals.partials.form-control', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection

{{-- @section('script')
    <script>
        $(document).ready(function() {

            $('#city').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('hospitals.select.district') }}",
                        method: "POST",
                        data: {
                            select: select,
                            value: value,
                            _token: _token,
                            dependent: dependent
                        },
                        success: function(result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });

            // $('#city').change(function() {
            //     $('#district').val('');
            // });




        });

    </script>
@endsection --}}
