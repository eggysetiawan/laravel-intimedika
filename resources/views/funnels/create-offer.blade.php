@extends('layouts.app', ['title'=>'Edit Penawaran'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('funnels.index') }}">Daftar Funnel</a></li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Update Penawaran</h3>
        </div>

        <form method="POST" action="{{ route('offerfunnel.update', $funnel->slug) }}">
            @csrf
            @method('patch')
            @include('offers.partials.form-control', ['submit' => 'Buat Penawaran'])
        </form>
    </x-card>
@endsection
