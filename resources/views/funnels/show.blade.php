@extends('layouts.app', ['title'=>'Buat Funnel'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('funnels.index') }}">Daftar Funnel</a></li>
    <li class="breadcrumb-item">{{ $funnel->offer->customer->hospitals->first()->name ?? $funnel->offer->customer->name }}
    </li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Detail Funnel</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <dt>Progress</dt>
            <p>{{ $funnel->progress }} %</p>
            <dt>Keterangan</dt>
            <p>{{ $funnel->description }}</p>
            <dt>Alat Kesehatan</dt>
            @php
                $i = 1;
            @endphp
            @foreach ($funnel->offer->orders as $order)
                <hr>
                <p>
                    <dt>Nama Modality #{{ $i++ }}</dt>
                <p>{{ $order->modality->name }}</p>
                <dt>Harga Modality</dt>
                <p>@currency($order->price)</p>
                </p>
            @endforeach

        </div>

    </x-card>
@endsection
