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
