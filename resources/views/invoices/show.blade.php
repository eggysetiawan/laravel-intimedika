@extends('layouts.app', ['title'=> $offer->slug])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Penawaran</a></li>
    <li class="breadcrumb-item">{{ Str::limit($offer->slug, 15) }}</li>
@endsection
@section('content')

    <div class="d-flex justify-content-lg-center">
        <div class="col-md-9">
            <div class="form-group">


                @switch($offer->approve)
                    @case(1)
                    <div class="text-success form-control-plaintext text-center">Approved!</div>
                    <a href="{{ route('invoices.print', $offer->slug) }}" target="_blank"
                        class="btn btn-info form-control">Print</a>
                    <form action="{{ route('invoices.repeat', $offer->invoices->first()->id) }}" method="post"
                        class="form-group">
                        @csrf
                        <button type="submit" class="btn bg-olive form-control-plaintext">Repeat Order</button>
                    </form>
                    @break
                    @case(2)
                    <div class="text-danger form-control-plaintext text-center">Rejected!</div>
                    @break
                    @default
                    @if (auth()
                ->user()
                ->isAdmin())
                        <form action="{{ route('approval.offers', $offer->slug) }}">
                            <div class="btn-group form-control-plaintext">
                                <button class="btn btn-success btn-sm" name="approval" type="submit" value="1"
                                    onclick="return confirm('apakah anda yakin?')">Approve.</button>
                                <button class="btn btn-danger btn-sm" name="approval" value="2"
                                    onclick="return confirm('apakah anda yakin?')">Reject.</button>
                            </div>
                        </form>
                    @endif

                @endswitch
            </div>
            <div class="wraps">
                <div class="card card-widget">

                    <div class="card-header">
                        <img style="width: 100%;" src="{{ asset('image/kopsurat2.png') }}" alt="">
                    </div>
                    <div class="card-body">
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
                                <table class="table table-responsive" border="1"
                                    style="border-collapse: collapse;width:100%">
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
                                        @if ($offer->approve == 1)
                                            {!! QrCode::generate(route('invoices.order', $offer->slug)) !!}
                                        @endif
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
        </div><!-- /.col -->
    </div><!-- /.row -->

@endsection
