@if (request('from') && request('to'))
    <div class="d-flex justify-content-center h4">
        <span style="font-weight: bold">{{ date('d F Y', strtotime(request('from'))) }}</span>&nbsp; s/d &nbsp;
        <span style="font-weight: bold">{{ date('d F Y', strtotime(request('to'))) }}</span>
        <span class="text-danger text-sm"><a href="{{ route('offers.index') }}">Reset</a></span>
    </div>
@endif
