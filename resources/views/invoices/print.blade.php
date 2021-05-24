<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/ipi2.png') }}" type="image/png">
    <style>
        .table-pdf th,
        .table-pdf td {
            font-size: 14px;
        }

    </style>
</head>

<body onload="window.print()">

    @include('invoices.partials.print')
    {{-- <script type="text/javascript">
    window.addEventListener("load", window.print());

</script> --}}

</body>

</html>

<script>
    var delayInMilliseconds = 1000; //1 second

    setTimeout(function() {
        window.close();

    }, delayInMilliseconds);

</script>
