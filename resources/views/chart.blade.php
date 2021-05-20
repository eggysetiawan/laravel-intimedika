<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1>{{ $chart->options['chart_title'] }}</h1>
                {!! $chart->renderHtml() !!}
            </div>
        </div>
    </div>
</div>
