@extends('layouts.app', ['title'=> 'Perjalanan Dinas'])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('advances.index') }}">Table Advance</a></li>
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

                <div class="card-body">
                    @include('advances.partials._form-control')
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
