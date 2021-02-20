@if (request('from') && request('to'))
    <div class="d-flex justify-content-center h4">
        <span style="font-weight: bold">{{ request('from') }}</span>&nbsp; s/d &nbsp;
        <span style="font-weight: bold">{{ request('to') }}</span>
        <span class="text-danger text-sm"><a href="{{ route('offers.index') }}">Reset</a></span>
    </div>
@endif
<div class="card-body">
    <div class="d-flex justify-content-end mt-3 mr-3">
        <form
            action="{{ request()->segment(1) == 'offers' && request()->segment(2) == 'complete' ? route('offers.filter-completed') : route('offers.filter') }}"
            method="GET">
            <span class="input-group justify-content-lg-end">
                <div class="col-md-4">
                    <label for="from">From</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-teal"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="search" value="{{ old('from') }}" name="from" id="datemask"
                            class="form-control @error('date') is-invalid @enderror" data-inputmask-alias="datetime"
                            data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="d-flex justify-content-start">
                        <label for="to">To</label>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-teal"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="search" name="to" value="{{ old('to') }}" id="datemask"
                            class="form-control @error('date') is-invalid @enderror" data-inputmask-alias="datetime"
                            data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                        <span class="input-group-append">
                            <button type="submit" class="btn bg-teal btn-sm">Filter</button>
                        </span>
                    </div>
                </div>
            </span>
        </form>
        @if (request()->segment(1) == 'hospitals-filter')
            <a href="{{ route('hospitals.index') }}" class="btn btn-warning btn-sm" style="margin-top:32px;">Reset</a>
        @endif
    </div>
</div>
