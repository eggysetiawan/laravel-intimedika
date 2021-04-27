@extends('layouts.app', ['title'=> 'Perjalanan Dinas'])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('advances.index') }}">Table Advance</a></li>
    <li class="breadcrumb-item">{{ Str::limit($advance->destination, 25, '...') }}</li>
@endsection
@section('content')
    <div class="col-md-12">
        <x-alert></x-alert>
        <div class="card card-teal">

            <div class="card-header">
                <h3 class="card-title">{{ $advance->destination ?? 'Advance Perjalanan' }}</h3>
            </div>

            <form method="post" action="{{ route('advances.update', $advance->slug) }}">
                @csrf
                <div class="card-body">
                    @include('advances.partials._form-control')
                </div>

                <div class="card-footer">
                    <x-button-submit>Buat Advance</x-button-submit>
                </div>

            </form>

        </div>
    </div>



@endsection

@section('script')
    @include('advances.partials._script-need')
@endsection('script')
