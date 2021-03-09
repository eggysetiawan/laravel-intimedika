@extends('layouts.app', ['title'=>'Edit Funnel'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('funnels.index') }}">Daftar Funnel</a></li>
    <li class="breadcrumb-item">{{ Str::limit($offer->customer->hospitals->first()->name, 15, '...') }}</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Buat Funnel</h3>
        </div>

        <form method="POST" action="{{ route('funnels.store') }}">
            @csrf
            @include('funnels.partials._form-control', ['submit' => 'Create'])
        </form>
    </x-card>
@endsection
