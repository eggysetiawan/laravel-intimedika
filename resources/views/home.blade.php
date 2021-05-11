@extends('layouts.app', ['title' => 'Beranda',])

@section('breadcrumb')
<li class="breadcrumb-item">Dashboard</li>
@endsection
@section('content')
<div class="container">
    @hasrole('superadmin|sales')
    <div class="row justify-content-start">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Target Tahunan
                </div>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{ $name }}</h5>
                    <p class="card-text">Rp
                        {{ number_format($offers, 0, ',', '.') }}/{{ number_format($targets, 0, ',', '.') }}
                    </p>
                    <div class="progress">
                        <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-valuenow="35"
                            aria-valuemin="0" aria-valuemax="100" style="width: {{ $percentage }}%">
                            <span class="sr-only">{{ $percentage }}% Complete (success)</span>
                        </div>
                    </div>

                    <div class="mt-1">
                        <a href="{{ route('offers.create') }}" class="btn bg-teal ">Buat Penawaran!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($charts as $chart)
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $chart->options['chart_title'] }}</h1>
                    {!! $chart->renderHtml() !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endhasrole

</div>
@endsection

@section('script')
{!! $chart1->renderChartJsLibrary() !!}

{!! $chart1->renderJs() !!}
@foreach ($charts as $chart)
{!! $chart->renderJs() !!}
@endforeach

@endsection
