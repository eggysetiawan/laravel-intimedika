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
                    <a href="{{ route('invoices.order', $offer->slug) }}" class="btn btn-info form-control"
                        target="_blank">
                        Lihat Detail Penawaran
                    </a>
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
@endsection
