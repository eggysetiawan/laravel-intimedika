@extends('layouts.app', ['title'=>'Setup Baru'])



@section('breadcrumb')
    <li class="breadcrumb-item">Setup Pin</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Whoops! something error.</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card card-teal">
                    <div class="card-header">
                        <h3 class="card-title">Setup Pin</h3>
                    </div>

                    <form method="POST" action="{{ route('pins.update') }}" autocomplete="off">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            @isset(auth()->user()->pin)
                                @include('pins.partials.change')
                            @else
                                @include('pins.partials.new')
                            @endisset
                            {{-- /card-body --}}
                        </div>
                        <div class="card-footer">
                            <x-button-submit>Buat Pin</x-button-submit>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
