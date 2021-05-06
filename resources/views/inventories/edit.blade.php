@extends('layouts.app', ['title'=>'Inventory'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('inventories.index') }}">Daftar Inventory</a></li>
    <li class="breadcrumb-item">Edit {{ $inventory->item }}</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Edit {{ $inventory->item }}</h3>
        </div>
        <form method="POST" action="{{ route('inventories.update', $inventory->slug) }}">
            @csrf
            @method('patch')
            @include('inventories.partials._form-control')
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#type').selectize({
                create: true,
                sortField: 'text'
            });
        });

    </script>
@endsection
