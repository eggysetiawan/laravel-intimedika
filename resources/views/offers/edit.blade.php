@extends('layouts.app', ['title'=>'Edit Penawaran'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Daftar Penawaran</a></li>
    <li class="breadcrumb-item">{{ Str::limit($offer->offer_no, 25, '...') }}</li>
@endsection

@section('content')
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
