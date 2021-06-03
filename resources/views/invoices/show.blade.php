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
                <div class="col-md-2">
                    <div class="nav flex-column nav-tabs h-100 " id="vert-tabs-tab" role="tablist"
                        aria-orientation="vertical" style="">

                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                            role="tab" aria-controls="vert-tabs-home" aria-selected="true">Penawaran</a>


                        {{-- <a class="nav-link @if (!$offer->purchaseApproved()) disabled @endif" id="vert-tabs-final-tab" data-toggle="pill" href="#vert-tabs-final"
                            role="tab" aria-controls="vert-tabs-final" aria-selected="false">Harga Final</a> --}}


                        <a class="nav-link" id="vert-tabs-order-tab" data-toggle="pill" href="#vert-tabs-order" role="tab"
                            aria-controls="vert-tabs-order" aria-selected="false">Order</a>


                        <a class="nav-link @if (!$offer->purchaseApproved()) disabled @endif" id="vert-tabs-cn-tab" data-toggle="pill"
                            href="#vert-tabs-cn" role="tab"
                            aria-controls="vert-tabs-cn" aria-selected="false">CN</a>

                        <a class="nav-link @if (!$offer->purchaseApproved()) disabled @endif" id="vert-tabs-komisi-tab" data-toggle="pill" href="#vert-tabs-komisi"
                            role="tab"
                            aria-controls="vert-tabs-komisi" aria-selected="false">Komisi</a>

                        <a class="nav-link @if (!$offer->hasDemo()) disabled @endif" id="vert-tabs-demo-tab" data-toggle="pill" href="#vert-tabs-demo"
                            role="tab"
                            aria-controls="vert-tabs-demo" aria-selected="false">Demo</a>

                    </div>
                </div>
                <div class="col-md-10">
                    <div class="tab-content" id="vert-tabs-tabContent">

                        {{-- tab_penawaran --}}
                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                            aria-labelledby="vert-tabs-home-tab">
                            <div class="form-group">
                                @switch($offer->is_approved)
                                    @case(1)
                                        <div class="d-flex justify-content-end">

                                            <button type="button" class="btn btn-warning mr-2" data-toggle="modal"
                                                data-target="#edit_note">Edit keterangan penawaran</button>

                                            {{-- print --}}
                                            <a href="{{ route('pdf.offer', $offer->slug) }}" target="_blank"
                                                class="btn btn-info mr-2"><i class="fas fa-print"></i></a>

                                            {{-- repeat order --}}
                                            @if ($offer->purchaseApproved())
                                                <button type="button" class="btn bg-olive" data-toggle="modal"
                                                    data-target="#repeatOrder">
                                                    Repeat Order
                                                </button>
                                            @endif
                                        </div>

                                    @break
                                    @case(2)
                                        <div class="btn btn-danger form-control-plaintext text-center">has been rejected!</div>
                                    @break

                                    @default
                                        @can('approval')
                                            {{-- when progress is ready to approve --}}
                                            <div class="btn-group form-control-plaintext">
                                                <a href="{{ route('verify.offer.approve', $offer->slug) }}"
                                                    class="btn btn-success btn-sm">Approve.</a>

                                                <a href="{{ route('revisions.edit', $offer->slug) }}"
                                                    class="btn btn-warning btn-sm text-white">Hold</a>

                                                <a href="{{ route('verify.offer.reject', $offer->slug) }}"
                                                    class="btn btn-danger btn-sm text-white">Reject.</a>
                                            </div>
                                        @endcan

                                        @if ($offer->is_approved == 3)
                                            {{-- when progress is on hold --}}
                                            <a href="{{ route('offers.edit', $offer->slug) }}"
                                                class="btn btn-warning form-control-plaintext text-white">Edit Penawaran</a>
                                        @endif

                                @endswitch
                            </div>
                            @include('invoices.partials.print')
                        </div>

                        {{-- tab_harga final --}}
                        <div class="tab-pane fade" id="vert-tabs-final" role="tabpanel"
                            aria-labelledby="vert-tabs-final-tab">

                            <div class="row justify-content-center">
                                <div class="text-center font-weight-bolder">
                                    <h2>Total Harga Penawaran Final </h2>
                                    <h4>
                                        @currency($offer->invoices->first()->orders->sum('price'))
                                    </h4>
                                </div>
                            </div>

                        </div>

                        {{-- tab_order --}}
                        <div class="tab-pane fade" id="vert-tabs-order" role="tabpanel"
                            aria-labelledby="vert-tabs-order-tab">

                            {{-- repeat order --}}
                            @can('view', $offer)
                                @if ($offer->progress->approval == 1)
                                    <button type="button" class="btn bg-olive form-control-plaintext mb-2" data-toggle="modal"
                                        data-target="#repeatOrder">
                                        <i class="fas fa-redo"></i> Repeat Order
                                    </button>
                                @endif
                            @endcan


                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i>
                                    <div class="d-flex justify-content-between">Order History
                                        <p>{{ $offer->offer_no }}</p>
                                    </div>
                                </h5>

                            </div>
                            <div class="scroll-less ">
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
                                                    @if ($invoice->getFirstMediaUrl('image_po', 'thumb'))
                                                        <dt>Foto Purchase-Order</dt>

                                                        <a href="{{ asset($invoice->getFirstMediaUrl('image_po', 'thumb')) }}"
                                                            data-toggle="lightbox"
                                                            data-title="Purhcase Order : {{ $offer->offer_no }}"
                                                            data-gallery="gallery">
                                                            <div class="product-image-thumb">
                                                                <img src="{{ asset($invoice->getFirstMediaUrl('image_po', 'thumb')) }}"
                                                                    class="img-fluid" alt="PO {{ $offer->slug }}" />
                                                            </div>
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
                                                                <td>@currency($invoice->tax->dpp ?? null)</td>
                                                            </tr>
                                                            <tr>
                                                                <th>PPN (10%)</th>
                                                                <td>@currency($invoice->tax->ppn ?? null)</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td>@currency($invoice->totalPurchase ?? null)</td>
                                                            </tr>
                                                            <hr>
                                                            <tr>
                                                                <th>Ongkos Kirim:</th>
                                                                <td>@currency($invoice->tax->shipping ?? null)</td>
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
                                                    @if ($offer->progress->progress == 99)
                                                        @can('view', $offer)

                                                            <a href="{{ route('verify.purchase.approve', $offer->slug) }}"
                                                                class="btn btn-success float-right" title="Setujui PO ini."><i
                                                                    class="fas fa-check-circle"></i> Approve
                                                                Purchase.</a>

                                                            <a href="{{ route('verify.purchase.reject', $offer->slug) }}"
                                                                class="btn btn-danger float-right" style="margin-right: 5px;"
                                                                title="Tolak PO ini."><i class="fas fa-times-circle"></i> Reject
                                                                Purchase.</a>

                                                        @endcan
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                @else

                                    @if ($offer->is_approved == 1)
                                        <a href="{{ route('progresses.create', $offer->slug) }}"
                                            class="btn btn-outline-success form-control-plaintext">Update Progress
                                            Penawaran</a>
                                    @else
                                        <div class="justify-content-center text-center">
                                            <h5 class="badge badge-info">There is no approved order.</h5>
                                        </div>
                                    @endif
                                @endif
                            </div>


                        </div>

                        {{-- tab_cn --}}
                        <div class="tab-pane fade" id="vert-tabs-cn" role="tabpanel" aria-labelledby="vert-tabs-cn-tab">

                            {{-- repeat order --}}
                            @can('view', $offer)
                                @if ($offer->progress->approval == 1)
                                    <button type="button" class="btn bg-olive form-control-plaintext mb-2" data-toggle="modal"
                                        data-target="#repeatOrder">
                                        <i class="fas fa-redo"></i> Repeat Order
                                    </button>
                                @endif
                            @endcan


                            <div class="callout callout-info">
                                <h5>
                                    <i class="fas fa-info"></i>
                                    <div class="d-flex justify-content-between">Total CN
                                        <p class="font-weight-bold">
                                            @currency($offer->taxes()->where('is_paid', 1)->sum('cn'))
                                        </p>
                                    </div>
                                </h5>

                            </div>
                            <div class="scroll-less ">
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
                                                    @if ($invoice->getFirstMediaUrl('image_po', 'thumb'))
                                                        <dt>Foto Purchase-Order</dt>

                                                        <a href="{{ asset($invoice->getFirstMediaUrl('image_po', 'thumb')) }}"
                                                            data-toggle="lightbox"
                                                            data-title="Purhcase Order : {{ $offer->offer_no }}"
                                                            data-gallery="gallery">
                                                            <div class="product-image-thumb">
                                                                <img src="{{ asset($invoice->getFirstMediaUrl('image_po', 'thumb')) }}"
                                                                    class="img-fluid" alt="PO {{ $offer->slug }}" />
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-6">
                                                    <p class="lead">{{ date('d/m/Y', strtotime($invoice->date)) }}</p>

                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Subtotal :</th>
                                                                <td>@currency($invoice->tax->price_po)</td>

                                                            </tr>
                                                            <tr>
                                                                <th style="width:50%">Ongkos Kirim :</th>
                                                                <td>@currency($invoice->tax->shipping) <span
                                                                        class="float-right font-weight-bold">_</span>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <th>Total :</th>
                                                                <td>@currency($invoice->totalCn)</td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:50%">CN
                                                                    {{ $invoice->tax->cn_percentage }}% :</th>
                                                                <td>@currency($invoice->tax->cn)</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status Pembayaran:</th>
                                                                <td>{{ $invoice->notPaidLabel() }}</td>
                                                            </tr>


                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <!-- tombol sudah bayar -->
                                            @include('invoices.partials.button-paid')
                                        </div>
                                    @endforeach

                                @else

                                    @if ($offer->is_approved == 1)
                                        <a href="{{ route('progresses.create', $offer->slug) }}"
                                            class="btn btn-outline-success form-control-plaintext">Update Progress
                                            Penawaran</a>
                                    @else
                                        <div class="justify-content-center text-center">
                                            <h5 class="badge badge-info">There is no approved order.</h5>
                                        </div>
                                    @endif
                                @endif
                            </div>


                        </div>

                        {{-- tab_komisi --}}
                        <div class="tab-pane fade" id="vert-tabs-komisi" role="tabpanel"
                            aria-labelledby="vert-tabs-komisi-tab">

                            {{-- repeat order --}}
                            @can('view', $offer)
                                @if ($offer->progress->approval == 1)
                                    <button type="button" class="btn bg-olive form-control-plaintext mb-2" data-toggle="modal"
                                        data-target="#repeatOrder">
                                        <i class="fas fa-redo"></i> Repeat Order
                                    </button>
                                @endif
                            @endcan


                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i>
                                    <div class="d-flex justify-content-between">Total Komisi
                                        <p class="font-weight-bold">
                                            @currency($offer->taxes()->where('is_paid',1)->sum('komisi'))
                                        </p>
                                    </div>
                                </h5>

                            </div>
                            <div class="scroll-less">
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
                                                    @if ($invoice->getFirstMediaUrl('image_po', 'thumb'))
                                                        <dt>Foto Purchase-Order</dt>

                                                        <a href="{{ asset($invoice->getFirstMediaUrl('image_po', 'thumb')) }}"
                                                            data-toggle="lightbox"
                                                            data-title="Purhcase Order : {{ $offer->offer_no }}"
                                                            data-gallery="gallery">
                                                            <div class="product-image-thumb">
                                                                <img src="{{ asset($invoice->getFirstMediaUrl('image_po', 'thumb')) }}"
                                                                    class="img-fluid" alt="PO {{ $offer->slug }}" />
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-6">
                                                    <p class="lead">{{ date('d/m/Y', strtotime($invoice->date)) }}</p>

                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Subtotal :</th>
                                                                <td>@currency($invoice->tax->price_po)</td>

                                                            </tr>
                                                            <tr>
                                                                <th style="width:50%">Ongkos Kirim :</th>
                                                                <td>@currency($invoice->tax->shipping) <span
                                                                        class="float-right font-weight-bold">_</span>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <th>Total :</th>
                                                                <td>@currency($invoice->totalCn)</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Komisi {{ $invoice->tax->komisi_percentage }}%:</th>
                                                                <td>@currency($invoice->tax->komisi)</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status Pembayaran:</th>
                                                                <td>{{ $invoice->notPaidLabel() }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                            {{-- row --}}

                                            <!-- tombol sudah bayar -->
                                            @include('invoices.partials.button-paid')
                                        </div>
                                    @endforeach

                                @else

                                    @if ($offer->is_approved == 1)
                                        <a href="{{ route('progresses.create', $offer->slug) }}"
                                            class="btn btn-outline-success form-control-plaintext">Update Progress
                                            Penawaran</a>
                                    @else
                                        <div class="justify-content-center text-center">
                                            <h5 class="badge badge-info">There is no approved order.</h5>
                                        </div>
                                    @endif
                                @endif
                            </div>


                        </div>

                        {{-- tab_demo --}}
                        <div class="tab-pane fade" id="vert-tabs-demo" role="tabpanel" aria-labelledby="vert-tabs-demo-tab">
                            <table>
                                <tr>
                                    <td>
                                        <dt>Keterangan &nbsp;:&nbsp;</dt>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $offer->progress->demo->description }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <dt>Tanggal &nbsp;:&nbsp;</dt>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $offer->progress->demo->date }}</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.card -->
    </div>


    <!-- Modal Repeat Order -->
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
                            <x-alert></x-alert>
                            @foreach ($offer->fixPrices as $order)
                                <div class="d-flex justify-content-center">

                                    <div class="col-md-6">
                                        {{-- price_po --}}
                                        <div class="row" style="margin-top: 30px">

                                            <div class="col-md-2">
                                                <input style="padding: 10px; width: 54px; height: 38px;" type="checkbox"
                                                    name="id_order[]" value="{{ $order->order_id }}">
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

                                    <div class="col-md-3">
                                        <div class="row" style="margin-top: 30px;">
                                            <div class="input-group mb-3">
                                                @isset($order->price)
                                                    <input type="text" value="@currency($order->price)"
                                                        class="form-control text-right" disabled>
                                                @else
                                                    <input type="text" name="price[{{ $order->order_id }}]" id="price"
                                                        class="form-control @error('price') is-invalid @enderror" required
                                                        data-inputmask="'mask': ['9,999','99,999','999,999','9,999,999', '99,999,999', '99,999,999', '999,999,999','9,999,999,999','99,999,999,999','999,999,999,999','9,999,999,999,999','99,999,999,999,999','999,999,999,999,999']"
                                                        data-mask>
                                                @endisset

                                                @error('price.*')
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
                                            <input type="text" name="qty[{{ $order->order_id }}]" id="qty"
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="img">Ongkos Kirim</label><br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="shipping" id="shipping"
                                            class="form-control @error('shipping') is-invalid @enderror" value="" required
                                            data-inputmask="'mask': ['9,999','99,999','999,999','9,999,999', '99,999,999', '99,999,999', '999,999,999','9,999,999,999','99,999,999,999','999,999,999,999','9,999,999,999,999','99,999,999,999,999','999,999,999,999,999']"
                                            data-mask>
                                        @error('shipping')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
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

    {{-- Modal edit form note --}}
    <div class="modal fade" id="edit_note" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-teal">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Keterangan Penawaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('offers.note_edit', $offer->slug) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal-body">

                        <input class="mr-2" style="margin: 0px" type="checkbox" name="form_up" id="form_up" @if ($offer->form_up) checked @endif><label for="form_up">Nama
                            Up.</label>
                        <div class="input-group">

                            <input type="text" name="name_up" id="name_up"
                                value="{{ $offer->name_up ?? $offer->customer->name }}" class="form-control"
                                placeholder="Input group example" aria-label="Input group example"
                                aria-describedby="btnGroupAddon">
                        </div>

                        <div class="form-group">
                            <input class="mr-2" style="margin: 0px" type="checkbox" name="has_form_note" id="has_form_note"
                                @if ($offer->has_form_note) checked @endif><label for="has_form_note">Keterangan Form</label>
                            <textarea name="form_note" class="form-control"
                                id="form_note">{{ $offer->form_note ?? (old('form_note') ?? '--Keterangan Penawaran--') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-teal">Edit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('invoices.partials.pin')
@endsection

@if (@$tab)
    @section('script')
        <script>
            function activaTab(tab) {
                $('.nav-tabs a[href="#' + tab + '"]').tab('show');
            };

            activaTab('vert-tabs-order');

        </script>
    @endsection
@endif
