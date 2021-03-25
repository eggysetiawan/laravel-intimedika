@extends('layouts.app', ['title'=>'Revisi Penawaran'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Daftar Penawaran</a></li>
    <li class="breadcrumb-item">{{ $offer->offer_no }}</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Revisi Penawaran</h3>
        </div>

        <form method="POST" action="{{ route('revisions.update', $offer->slug) }}">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                    {{-- <a href="{{ route('invoices.order', $offer->slug) }}" class="btn btn-info form-control"
                        target="_blank">
                        Lihat Detail Penawaran
                    </a> --}}

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#exampleModal">
                        Lihat detail penawaran
                    </button>

                </div>
                <div class="form-group">
                    <label for="reason">Berikan Alasan Revisi</label>
                    <textarea name="reason" id="reason" class="form-control @error('reason') is-invalid @enderror" cols="30"
                        rows="4">{{ old('reason') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="is_called" id="is_called" class="" value="1">
                    <label for="is_called">Minta Sales untuk menghadap.</label>
                </div>
            </div>
            <div class="card-footer">
                <x-button-submit>Revisi Penawaran</x-button-submit>
            </div>
        </form>
    </x-card>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-teal">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Penawaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                                        <td style="font-weight: bold;font-size: 14px">Up. Bpk/Ibu
                                            {{ $offer->customer->name }}
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
                                        <table class="table table-responsive " border="1"
                                            style="border-collapse: collapse;width:100%">
                                            <thead class="thead-dark ">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>
                                                        <center>Nama Alat</center>
                                                    </th>
                                                    <th>
                                                        <center>Harga Satuan</center>
                                                    </th>

                                                </tr>
                                            </thead>
                                            @foreach ($offer->invoices->last()->orders as $order)
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
                                                    <td class="text-center">
                                                        @currency($order->price)
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
                                    <p style="font-size: 14px"> Demikian penawaran ini kami sampaikan, kami tunggu
                                        kabar baik
                                        selanjutnya, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>

                                    <div style="width: 100%;">
                                        <div style="float: left;">
                                            Hormat kami,<br>
                                            <b><label style="font-weight: bold;">PT. Intimedika Puspa
                                                    Indah</label></b>
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
                                                @if ($offer->is_approved == 1)
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-teal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
