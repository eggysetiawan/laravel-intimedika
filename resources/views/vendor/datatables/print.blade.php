<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Table</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        body {
            margin: 20px
        }

    </style>
</head>

<body>
    <table class="table table-bordered table-condensed table-striped">
        @foreach ($data as $row)
            @if ($loop->first)
                <tr>
                    @foreach ($row as $key => $value)
                        <th>{!! $key !!}</th>
                    @endforeach
                </tr>
            @endif
            <tr>
                @foreach ($row as $key => $value)
                    @if (is_string($value) || is_numeric($value))
                        <td>{!! $value !!}</td>
                    @else
                        <td></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</body>

</html>

<script type="text/javascript">
    window.addEventListener("load", window.print());

</script>
