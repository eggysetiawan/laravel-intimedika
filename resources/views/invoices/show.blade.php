@extends('layouts.app', ['title'=> $offer->slug])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Penawaran</a></li>
    <li class="breadcrumb-item">{{ Str::limit($offer->slug, 15) }}</li>
@endsection
@section('content')

    <div class="card card-teal card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Detail Penawaran
            </h3>
        </div>
        <div class="card-body">
            <h4>Menu</h4>
            <div class="row">
                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100 " id="vert-tabs-tab" role="tablist"
                        aria-orientation="vertical" style="">
                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                            role="tab" aria-controls="vert-tabs-home" aria-selected="true">Penawaran</a>
                        <a class="nav-link" id="vert-tabs-order-tab" data-toggle="pill" href="#vert-tabs-order" role="tab"
                            aria-controls="vert-tabs-order" aria-selected="false">Order</a>
                        {{-- <a class="nav-link" id="vert-tabs-order-tab" data-toggle="pill" href="#vert-tabs-order"
                            role="tab" aria-controls="vert-tabs-order" aria-selected="false">additional tab</a> --}}

                    </div>
                </div>
                <div class="col-7 col-sm-9 scroll-less">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                            aria-labelledby="vert-tabs-home-tab">
                            <div class="form-group">


                                @switch($offer->approve)
                                    @case(1)

                                    {{-- print --}}
                                    <a href="{{ route('invoices.print', $offer->slug) }}" target="_blank"
                                        class="btn btn-info form-control">Print</a>

                                    {{-- repeat order --}}
                                    @if ($offer->progress->approval == 1)
                                        <button type="button" class="btn bg-olive form-control-plaintext" data-toggle="modal"
                                            data-target="#repeatOrder">
                                            Repeat Order
                                        </button>
                                    @endif
                                    @break
                                    @case(2)
                                    <div class="text-danger form-control-plaintext text-center">Rejected!</div>
                                    @break
                                    @default
                                    {{-- approve penawaran --}}
                                    @if (auth()
                ->user()
                ->isAdmin())
                                        <form action="{{ route('approval.offers', $offer->slug) }}" method="POST">
                                            @csrf
                                            @method('patch')
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
                                                <table class="table table-responsive" border="1"
                                                    style="border-collapse: collapse;width:100%">
                                                    <thead class="thead-dark">
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
                                                                <div
                                                                    style="text-align: justify;text-justify:auto;justify-content">
                                                                    <pre>{{ $order->modality->spec }}</pre><br>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    @currency($order->price)
                                                                </center>
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
                                                    <p
                                                        style="text-decoration: underline; margin-bottom: 0px; font-weight: bold;">
                                                        {{ $offer->author->name }}
                                                    </p>
                                                    <label style="text-dec ;">Marketing</label>
                                                </div>
                                                <div style="float: right; padding-right: 3px;">
                                                    Mengetahui,<br>

                                                    <div
                                                        style="height:130px; padding: 20px 0px 0px 0px; margin-bottom: 22px;">
                                                        @if ($offer->approve == 1)
                                                            {!! QrCode::generate(route('invoices.order', $offer->slug)) !!}
                                                        @endif
                                                    </div>
                                                    <p
                                                        style="text-decoration: underline; margin-bottom: 0px; font-weight: bold;">
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
                        <div class="tab-pane fade" id="vert-tabs-order" role="tabpanel"
                            aria-labelledby="vert-tabs-order-tab">
                            @if ($offer->progress->progress == 99 && auth()->user()->level == 'top')
                                <form action="{{ route('approval.progress', $offer->slug) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="btn-group form-control-plaintext">
                                        <button class="btn btn-success btn-sm" name="approval" type="submit" value="1"
                                            onclick="return confirm('apakah anda yakin?')">Approve PO.</button>
                                        <button class="btn btn-danger btn-sm" name="approval" value="2"
                                            onclick="return confirm('apakah anda yakin?')">Reject PO.</button>
                                    </div>
                                </form>
                            @endif
                            {{-- repeat order --}}
                            @if ($offer->progress->approval == 1)
                                <button type="button" class="btn bg-olive form-control-plaintext mb-2" data-toggle="modal"
                                    data-target="#repeatOrder">
                                    <i class="fas fa-redo"></i> Repeat Order
                                </button>
                            @endif
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i>
                                    <div class="d-flex justify-content-between">Order History
                                        <p>{{ $offer->offer_no }}</p>
                                    </div>
                                </h5>

                            </div>
                            @if ($offer->progress->progress >= 99)
                                @foreach ($offer->invoices as $invoice)
                                    <!-- Main content -->
                                    <div class="invoice p-3 mb-3">
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>
                                                    <i class="fas fa-globe"></i>
                                                    {{ $invoice->offer->customer->hospitals->first()->name ?? $invoice->offer->customer->name }}
                                                    <small class="float-right">Date:
                                                        {{ date('d/m/Y', strtotime($invoice->date)) }}</small>
                                                </h4>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                From
                                                <address>
                                                    <strong>{{ $invoice->offer->author->name }}</strong><br>
                                                    {{ $invoice->offer->author->address }}<br>
                                                    {{ $invoice->offer->author->city }}<br>
                                                    Phone: {{ $invoice->offer->author->phone }}<br>
                                                    Email: {{ $invoice->offer->author->email }}
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                To
                                                <address>
                                                    <strong>{{ $invoice->offer->customer->hospitals->first()->name ?? $invoice->offer->customer->name }}</strong><br>
                                                    {{ $invoice->offer->customer->address }}<br>
                                                    {{ $invoice->offer->customer->city }}<br>
                                                    Phone: {{ $invoice->offer->customer->mobile }}<br>
                                                    Email: {{ $invoice->offer->customer->email }}
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <b>Invoice #007612</b><br>
                                                <br>
                                                <b>Order ID:</b> 4F3S8J<br>
                                                <b>Payment Due:</b> 2/22/2014<br>
                                                <b>Account:</b> 968-34567
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Qty</th>
                                                            <th>Alat</th>
                                                            <th>Spesifikasi</th>
                                                            <th>Price List</th>
                                                            <th>Harga Purchase-Order</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($invoice->orders->whereNotNull('quantity') as $order)
                                                            <tr>
                                                                <td>{{ $order->quantity }}</td>
                                                                <td>{{ $order->modality->name }}</td>
                                                                <td>{{ $order->modality->spec }}</td>
                                                                <td>@currency($order->modality->price)</td>
                                                                <td>@currency($order->price)</td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-6">
                                                @if ($invoice->getFirstMediaUrl('image_po'))
                                                    <dt>Foto Purchase-Order</dt>

                                                    <a href="{{ asset($invoice->getFirstMediaUrl('image_po')) }}"
                                                        data-toggle="lightbox"
                                                        data-title="Purhcase Order : {{ $offer->offer_no }}"
                                                        data-gallery="gallery">
                                                        <img src="{{ asset($invoice->getFirstMediaUrl('image_po')) }}"
                                                            class="img-fluid mb-2" alt="PO {{ $offer->slug }}"
                                                            width="150px" />
                                                    </a>
                                                @endif
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-6">
                                                <p class="lead">{{ date('d/m/Y', strtotime($invoice->date)) }}</p>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th style="width:50%">Subtotal:</th>
                                                            <td>@currency($invoice->tax->dpp)</td>
                                                        </tr>
                                                        <tr>
                                                            <th>PPN (10%)</th>
                                                            <td>@currency($invoice->tax->ppn)</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Ongkos Kirim:</th>
                                                            <td>@currency($invoice->tax->shipping)</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td>@currency($invoice->tax->price_po + $invoice->tax->ppn)</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-12">
                                                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i
                                                        class="fas fa-print"></i> Print</a>
                                                <button type="button" class="btn btn-success float-right"><i
                                                        class="far fa-credit-card"></i> Submit
                                                    Payment
                                                </button>
                                                <button type="button" class="btn btn-primary float-right"
                                                    style="margin-right: 5px;">
                                                    <i class="fas fa-download"></i> Generate PDF
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @else
                                <div class="justify-content-center text-center">
                                    <h5 class="badge badge-info">There is no order approved.</h5>
                                </div>
                            @endif


                        </div>
                        {{-- <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                            aria-labelledby="vert-tabs-messages-tab"> --}}
                        {{-- new tab --}}
                        {{-- </div> --}}

                    </div>
                </div>
            </div>

        </div>
        <!-- /.card -->
    </div>


    {{-- repeat order --}}
    <!-- Modal -->
    <div class="modal fade" id="repeatOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-teal">
                    <h5 class="modal-title" id="exampleModalLabel">Repeat Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('invoices.repeat', $offer->invoices->first()->id) }}" method="post"
                    class="form-group" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <dt>Pilih Modality yang ingin di order.</dt>
                            @foreach ($offer->invoices->last()->orders as $order)

                                <div class="d-flex justify-content-center">

                                    <div class="col-md-6">
                                        {{-- price_po --}}
                                        <div class="row" style="margin-top: 30px">

                                            <div class="col-md-2">
                                                <input type="checkbox" name="id_order[]" value="{{ $order->id }}">
                                            </div>
                                            <div class="col-md-10">

                                                <input type="text" disabled id="disabled"
                                                    class="form-control @error('disabled') is-invalid @enderror"
                                                    value="{{ $order->modality->name }}">
                                                @error('disabled')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        {{-- price_po --}}
                                        @if ($loop->first)
                                            <label for="shipping">Qty</label>
                                        @else
                                            <label for="shipping">&nbsp;</label>
                                        @endif
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Qty</span>
                                            </div>
                                            <input type="text" name="qty[{{ $order->id }}]" id="qty"
                                                class="form-control @error('qty') is-invalid @enderror" placeholder="unit"
                                                required>
                                            @error('qty')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="img">Masukan bukti PO</label><br>
                            <input type="file" name="img" id="img" class="@error('img') is-invalid @enderror">
                            @error('img')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <x-button-submit>Repeat</x-button-submit>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
