<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/ipi2.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <table class="table ">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>No. Penawaran</th>
                        <th>Customer/Rumah Sakit</th>
                        <th>Tgl.</th>
                        <th>Keterangan</th>
                        <th>Sales</th>
                        <th>Nilai Kontrak</th>
                        <th>DPP</th>
                        <th>PPN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as $offer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $offer->offer_no }}</td>
                            <td>{{ $offer->customer->hospitals->first()->name ?? $offer->customer->name }}</td>
                            <td>{{ $offer->offer_date }}</td>
                            <td>{{ $offer->progress->detail }}</td>
                            <td>{{ $offer->author->name }}</td>
                            <td>@currency($offer->invoices->last()->tax->price_po)</td>
                            <td>@currency($offer->invoices->last()->tax->dpp)</td>
                            <td>@currency($offer->invoices->last()->tax->ppn)</td>
                        </tr>
                    @empty
                        Belum ada data.
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>
