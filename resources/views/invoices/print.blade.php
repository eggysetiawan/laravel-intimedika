<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/ipi2.png') }}" type="image/png">
</head>

<body onload="window.print()">

    <div class="wraps">
        <div class="card card-widget">

            <div class="card-header">
                <img style="width: 100%;" src="{{ asset('image/kopsurat2.png') }}" alt="">
            </div>
            <div class="card-body">
                @isset($offer->is_approved)
                    <label style="font-size: 14px; float:right">Jakarta,
                        {{ date('d F Y', strtotime($offer->approved_at)) }}</label>
                @endisset
                <table>
                    <tr>

                        <td style="font-size: 14px">No</td>
                        <?php for ($i = 1; $i <= 9; $i++): ?> <td
                            style="font-size: 14px">
                            &nbsp;</td>
                            <?php endfor; ?>
                            <td style="font-size: 14px">:</td>
                            <td style="font-size: 14px">{{ $offer->offer_no }}</td>

                    </tr>
                    <tr>
                        <td style="font-size: 14px">Perihal</td>
                        <?php for ($i = 1; $i <= 9; $i++): ?> <td
                            style="font-size: 14px">
                            &nbsp;</td>
                            <?php endfor; ?>
                            <td style="font-size: 14px">:</td>
                            <td style="font-size: 14px">Penawaran</td>

                    </tr>
                </table>

                <br>
                <table>
                    <tr>
                        <td style="font-size: 14px">Kepada Yth,</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;font-size: 14px">
                            {{ $offer->customer->hospitals->first()->name ?? $offer->customer->name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px">{{ $offer->customer->address }}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;font-size: 14px">Up. Bpk/Ibu {{ $offer->customer->name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px">{{ $offer->customer->role }}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px">Dengan hormat,</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px">ket_form</td>
                    </tr>
                </table>
                <div class="fill">
                    <div class="detail-table">
                        <table class="table" border="1" style="border-collapse: collapse;width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>
                                        <center>Nama Alat</center>
                                    </th>
                                    <th>
                                        <center>Qty</center>
                                    </th>
                                    <th>
                                        <center>Harga Satuan</center>
                                    </th>
                                    <th>
                                        <center> Harga Total</center>
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($offer->invoices->first()->orders as $order)
                                <tr>
                                    <td>
                                        <center>{{ $loop->iteration }}</center>
                                    </td>
                                    <td>
                                        <div style=" font-weight: bold;" class="mt-0">
                                            {{ $order->modality->name }}
                                        </div>
                                        <br>
                                        Merk : {{ $order->modality->brand }}<br>
                                        Model : {{ $order->modality->model }}
                                        <div style="text-align: justify;text-justify:auto;justify-content">
                                            <pre>{{ $order->modality->spec }}</pre><br>
                                        </div>
                                    </td>
                                    <td>
                                        <center>{{ $order->quantity }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            @currency($order->price)
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            @currency($order->quantity * $order->price)<br>
                                            images</center>
                                    </td>
                                </tr>
                            @endforeach


                        </table>
                    </div>
                    <table>
                        <tr>
                            <td style="font-size: 14px">Kondisi Penawaran</td>
                            <td style="font-size: 14px">:</td>
                        </tr>
                    </table>
                    <table>
                        @if ($offer->price_note)
                            <tr>
                                <td style="font-size: 14px">Harga</td>
                                <td style="font-size: 14px">:</td>
                                <td style="font-size: 14px">{{ $offer->price_note }}</td>
                            </tr>
                        @endif
                        @if ($offer->availability_note)

                            <tr>
                                <td style="font-size: 14px">Penyerahan</td>
                                <td style="font-size: 14px">:</td>
                                <td style="font-size: 14px">{{ $offer->availability_note }}</td>
                            </tr>
                        @endif

                        @if ($offer->payment)

                            <tr>
                                <td style="font-size: 14px">Pembayaran/Penawaran</td>
                                <td style="font-size: 14px">:</td>
                                <td style="font-size: 14px">{{ $offer->payment }}</td>
                            </tr>
                        @endif
                        @if ($offer->note)
                            <tr>
                                <td style="font-size: 14px">Keterangan</td>
                                <td style="font-size: 14px">:</td>
                                <td style="font-size: 14px">{{ $offer->note }}</td>
                            </tr>
                        @endif

                    </table>
                    <p style="font-size: 14px"> Demikian penawaran ini kami sampaikan, kami tunggu kabar baik
                        selanjutnya, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>

                    <div style="width: 100%;">
                        <div style="float: left;">
                            Hormat kami,<br>
                            <b><label style="font-weight: bold;">PT. Intimedika Puspa Indah</label></b>
                            <div style="height:130px;">

                            </div>
                            <p style="text-decoration: underline; margin-bottom: 0px; font-weight: bold;">
                                {{ $offer->author->name }}
                            </p>
                            <label style="text-dec ;">Marketing</label>
                        </div>
                        <div style="float: right; padding-right: 3px;">
                            Mengetahui,<br>

                            <div style="height:130px; padding: 20px 0px 0px 0px; margin-bottom: 22px;">
                                {!! QrCode::generate(route('invoices.order', $offer->slug)) !!}
                            </div>
                            <p style="text-decoration: underline; margin-bottom: 0px; font-weight: bold;">
                                Johannes Hendrajaja</p>
                            <label style="text-dec ;">Direktur</label>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

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
