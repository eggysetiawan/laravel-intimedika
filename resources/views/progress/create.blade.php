@extends('layouts.app', ['title' => $offer->offer_no])


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Penawaran</a></li>
    <li class="breadcrumb-item">Edit Progress</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title ">
                <div>Progress Penawaran</div>
            </h3>
        </div>

        <form role="form" method="post" action="{{ route('progresses.store', $offer->progress->id) }}" novalidate
            enctype="multipart/form-data">
            @csrf
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
                            <input name="demo_date" type="text" class="form-control"
                                value="{{ $offer->progress->demo->date ?? '' }}" data-inputmask-alias="datetime"
                                data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                        </div>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control mt-1"
                            placeholder="Berikan keterangan presentasi/demo">{{ $offer->progress->demo->description }}</textarea>
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
                        <input type="checkbox" name="progress" id="check6" value="100">
                        <label for="check6">
                            Sudah ada PO.
                        </label>

                        <div id="img">

                            {{-- price_po --}}
                            <label for="shipping">Harga Pre-Order</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="price_po" id="price_po"
                                    class="form-control @error('price_po') is-invalid @enderror"
                                    data-inputmask="'mask': ['9.999','99.999','999.999','9.999.999', '99.999.999', '99.999.999', '999.999.999','9.999.999.999','99.999.999.999','999.999.999.999','9.999.999.999.999','99.999.999.999.999','999.999.999.999.999']"
                                    data-mask value="{{ old('price_po') }}" required>
                            </div>



                            {{-- ongkir --}}
                            <label for="shipping">Ongkos Kirim</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="shipping" id="shipping"
                                    class="form-control @error('shipping') is-invalid @enderror"
                                    data-inputmask="'mask': ['9.999','99.999','999.999','9.999.999', '99.999.999', '99.999.999', '999.999.999','9.999.999.999','99.999.999.999','999.999.999.999','9.999.999.999.999','99.999.999.999.999','999.999.999.999.999']"
                                    data-mask value="{{ old('shipping') }}" required>
                            </div>

                            {{-- image --}}
                            <div class="form-group">
                                <input type="file" name="img">
                            </div>
                        </div>
                    </div>


                    <div class="form-group mt-5">
                        <input type="radio" name="status" id="status1">
                        <label for="status1">Cold</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="status" checked id="status2">
                        <label for="status2">On Progress</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="status" id="status3">
                        <label for="status3">Hold</label>
                    </div>


                    <div class="form-group">
                        <textarea name="detail" id="detail"  rows="4" class="form-control" placeholder="Berikan keterangan progress.."></textarea>
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
                if ($(this).is(":checked")) {
                    $("#img").show(300);
                } else {
                    $("#img").hide(200);
                }
            });
            $("#img").hide();
        });

    </script>
@endsection
