@extends('layouts.app', ['title'=>'Penawaran'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Daftar Penawaran</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-teal">
                    <div class="card-header">
                        <h3 class="card-title">Buat Penawaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form method="POST" action="{{ route('offers.store') }}" novalidate>
                        @csrf
                        @include('offers.partials.form-control', ['submit' => 'Create'])
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {


            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd-mm-yyyy', {
                'placeholder': 'dd-mm-yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()




            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })



        })

    </script>
@endsection
