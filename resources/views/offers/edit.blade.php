@extends('layouts.app', ['title'=>'Edit Penawaran'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Daftar Penawaran</a></li>
    <li class="breadcrumb-item">{{ $offer->offer_no }}</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Edit Penawaran</h3>
        </div>

        <form method="POST" action="{{ route('offers.update', $offer->slug) }}">
            @csrf
            @method('patch')
            @include('offers.partials.form-control', ['submit' => 'Update'])
        </form>
    </x-card>
@endsection
