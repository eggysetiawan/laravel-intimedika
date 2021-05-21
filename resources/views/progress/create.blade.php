@extends('layouts.app', ['title' => $offer->offer_no])


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Penawaran</a></li>
    <li class="breadcrumb-item">Edit Progress</li>
@endsection

@section('content')
    <x-alert></x-alert>

    <x-card>
        <div class="card-header">
            <h3 class="card-title ">
                <div>Progress Penawaran</div>
            </h3>
        </div>

        <form role="form" method="post" action="{{ route('progresses.update', $offer->slug) }}" novalidate
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card-body">


                <div class="h5">
                    <div class="form-group icheck-danger">
                        <input type="checkbox" name="progress" id="check1" value="30" @if ($offer->progress->progress >= 30) checked @endif>
                        <label for="check1">
                            Sudah ada penawaran harga.
                        </label>
                    </div>
                    <div class="form-group icheck-danger">
                        <input type="checkbox" name="progress" id="check2" value="50" @if ($offer->progress->progress >= 50) checked @endif>
                        <label for="check2">
                            Presentasi dan demo produk.
                        </label>
                    </div>
                    <div class="form-group" id="mycheckboxdiv">
                        <label for="date">Tanggal & keterangan presentasi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input name="demo_date" type="text"
                                class="form-control @error('demo_date') is-invalid @enderror"
                                value="{{ $offer->progress->demo->date ?? old('demo_date') }}"
                                data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                            @error('demo_date')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <textarea name="description" id="" cols="30" rows="10"
                            class="form-control @error('description') is-invalid @enderror mt-1"
                            placeholder="Berikan keterangan presentasi/demo">{{ $offer->progress->demo->description ?? old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group icheck-danger">
                        <input type="checkbox" name="progress" id="check3" value="70" @if ($offer->progress->progress >= 70) checked @endif>
                        <label for="check3">
                            User cocok dengan spesifikasi barang.
                        </label>
                    </div>

                    <div class="form-group icheck-danger">
                        <input type="checkbox" name="progress" id="check4" value="85" @if ($offer->progress->progress >= 85) checked @endif>
                        <label for="check4">
                            Sudah ada negosiasi harga dengan user/pengadaan.
                        </label>
                    </div>

                    <div class="form-group icheck-danger">
                        <input type="checkbox" name="progress" id="check5" value="90" @if ($offer->progress->progress >= 90) checked @endif>
                        <label for="check5">
                            Anggaran sudah ada dan cocok.
                        </label>
                    </div>

                    <div class="form-group icheck-danger">
                        <input type="checkbox" name="progress" id="check6" value="99" @if ($offer->progress->progress == 99) checked @endif @if (old('progress')) checked @endif )>
                        <label for="check6">
                            Sudah ada PO.
                        </label>

                        <div id="img">

                            @foreach ($offer->invoices->first()->orders as $order)
                                @php
                                    $i++;
                                @endphp
                                <div class="attachment-block clearfix px-0 mx-0">
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
                                        <div class="col-md-3">
                                            {{-- price_po --}}
                                            @if ($loop->first)
                                                <label for="shipping">Purchase-Order</label>
                                            @else
                                                <label for="shipping">&nbsp;</label>
                                            @endif
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="hidden" name="references[]" value="{{ $order->references }}">
                                                <input type="text" name="price[]" id="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price.' . ($i - 1)) }}" required
                                                    data-inputmask="'mask': ['9,999','99,999','999,999','9,999,999', '99,999,999', '99,999,999', '999,999,999','9,999,999,999','99,999,999,999','999,999,999,999','9,999,999,999,999','99,999,999,999,999','999,999,999,999,999']"
                                                    data-mask>

                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
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
                                                <input type="number" name="qty[]" id="qty"
                                                    class="form-control @error('qty') is-invalid @enderror"
                                                    placeholder="unit" required value="{{ old('qty.' . ($i - 1)) }}">
                                                @error('qty')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <label for="cn">Nilai CN</label>
                                    <select name="cn" id="cn" class="form-control select2">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}%</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md">
                                    {{-- ongkir --}}
                                    <label for="shipping">Ongkos Kirim</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="shipping" id="shipping"
                                            class="form-control @error('shipping') is-invalid @enderror"
                                            data-inputmask="'mask': ['9,999','99,999','999,999','9,999,999', '99,999,999', '99,999,999', '999,999,999','9,999,999,999','99,999,999,999','999,999,999,999','9,999,999,999,999','99,999,999,999,999','999,999,999,999,999']"
                                            data-mask value="{{ old('shipping') }}" required>
                                        @error('shipping')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            {{-- image --}}
                            <div class="form-group">
                                <input type="file" name="img" class="@error('img') is-invalid @enderror"
                                    value="{{ old('img') }}">
                                @error('img')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <div class="form-group mt-5">
                        <input type="radio" name="status" id="status1" value="Cold">
                        <label for="status1">Cold</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="status" checked id="status2" value="On Progress">
                        <label for="status2">On Progress</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="status" id="status3" value="Hold">
                        <label for="status3">Hold</label>
                    </div>


                    <div class="form-group">
                        <textarea name="detail" id="detail" rows="4"
                            class="form-control @error('detail') is-invalid @enderror"
                            placeholder="Berikan keterangan progress..">{{ old('detail') ?? $offer->progress->detail }}</textarea>
                        @error('detail')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <x-button-submit>Submit</x-button-submit>
                </div>

            </div>
        </form>
    </x-card>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#check2").click(function() {
                if ($(this).is(":checked")) {
                    $("#mycheckboxdiv").show(300);
                } else {
                    $("#mycheckboxdiv").hide(200);
                }
            });
            $("#mycheckboxdiv").hide();
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#check6").click(function() {
                    const progress = "{{ $offer->progress->progress }}";
                    if ($(this).is(":checked") || progress == 99) {
                        $("#img").show(300);
                    }

                } else {
                    $("#img").hide(200);
                }
            }); $("#img").hide();
        });

    </script>
@endsection
