@extends('layouts.app', ['title' => 'Beranda',])

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <h1>{{ $chart1->options['chart_title'] }}</h1>
                        {!! $chart1->renderHtml() !!}



                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <h1>{{ $chart5->options['chart_title'] }}</h1>
                        {!! $chart5->renderHtml() !!}



                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <h1>{{ $chart2->options['chart_title'] }}</h1>
                        {!! $chart2->renderHtml() !!}



                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <h1>{{ $chart3->options['chart_title'] }}</h1>
                        {!! $chart3->renderHtml() !!}



                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <h1>{{ $chart4->options['chart_title'] }}</h1>
                        {!! $chart4->renderHtml() !!}



                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')
    {!! $chart1->renderChartJsLibrary() !!}

    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
    {!! $chart3->renderJs() !!}
    {!! $chart4->renderJs() !!}
    {!! $chart5->renderJs() !!}
@endsection
