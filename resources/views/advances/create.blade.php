@extends('layouts.app', ['title'=> 'title disini'])

@section('breadcrumb')
    <li class="breadcrumb-item">Buat Advance Perjalanan</li>
@endsection
@section('content')
    <div class="col-md-12 ">
        <x-alert></x-alert>
        <div class="card card-teal">

            <div class="card-header">
                <h3 class="card-title">{{ $tableHeader ?? 'Advance Perjalanan' }}</h3>
            </div>

            <form method="post" action="{{ route('advances.store') }}">

                @csrf
                <input type="hidden" id="count" name="count" value="{{ old('count') }}">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="destination">Tempat</label>
                                <input type="text" name="destination" id="destination" class="form-control"
                                    placeholder="Tuliskan Rumah Sakit yang akan dikunjungi..">
                            </div>

                            <div class="form-group">
                                <label for="destination">Tujuan</label>
                                <textarea name="objective" class="form-control" id="objective" rows="2"
                                    placeholder="Tuliskan tujuan dilakukannya perjalanan.."></textarea>
                            </div>

                        </div>
                    </div>


                    <div class="row justify-content-center">

                        <div class="col-md-6">
                            <label for="start_date">Tanggal Keberangkatan</label>
                            <div class="form-group">
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="end_date">Tanggal Kepulangan</label>
                            <div class="form-group">
                                <input type="date" name="end_date" id="start_date" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table table-striped" id="user_table">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="20%">Keperluan</th>
                                            <th width="20%">Harga</th>
                                            <th width="10%">Hari</th>
                                            {{-- <th width="20%">Total Biaya</th> --}}
                                            <th width="100%">Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <x-button-submit>Buat Advance</x-button-submit>
                </div>

            </form>

        </div>
    </div>



@endsection

@section('script')
    <script>
        $(document).ready(function() {

            var count = 1;

            dynamic_field(count);

            function dynamic_field(number) {
                html = '<tr>';
                html += '<td>' + count + '</td>';
                html += '<td><input type="text" name="needs[]" class="form-control" /></td>';
                html += '<td><input type="text" name="prices[]" class="form-control" /></td>';
                html += '<td><input type="text" name="days[]" class="form-control" /></td>';
                // html += '<td><input type="text" name="totals[]" class="form-control" /></td>';
                html += '<td><textarea name="notes[]" class="form-control" rows="4"></textarea></td>';
                if (number > 1) {
                    html +=
                        '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                    $('tbody').append(html);
                } else {
                    html +=
                        '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                    $('tbody').html(html);
                }
            }

            $(document).on('click', '#add', function() {
                count++;
                dynamic_field(count);
                var countField = $('#count').val(count);

            });

            $(document).on('click', '.remove', function() {
                count--;
                $(this).closest("tr").remove();
                var countField = $('#count').val(count);
            });


        });

    </script>
@endsection('script')
