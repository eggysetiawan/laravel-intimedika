<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/ipi2.png') }}" type="image/png">

</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Penawaran</th>
                        <th>Customer/Rumah Sakit</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Sales</th>
                        <th>Referensi</th>
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
                            <td>
                                @php
                                    $orders = $offer->invoices->last()->orders;
                                    $references = [];
                                    foreach ($orders as $order):
                                        $references[] = $order->references;
                                    endforeach;
                                    $references = join(' & ', array_unique($references));
                                @endphp
                                {{ $references }}
                            </td>
                            <td>{{ $offer->invoices->last()->tax->price_po }}</td>
                            <td>{{ $offer->invoices->last()->tax->dpp }}</td>
                            <td>{{ $offer->invoices->last()->tax->ppn }}</td>
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
