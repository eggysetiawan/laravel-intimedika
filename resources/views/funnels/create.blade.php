@extends('layouts.app', ['title'=>'Buat Funnel'])



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('funnels.index') }}">Daftar Funnel</a></li>
    <li class="breadcrumb-item">Tambah</li>
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

@section('script')
    @include('customers.partials._select-customer')
@endsection
