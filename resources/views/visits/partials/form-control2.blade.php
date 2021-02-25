<div class="card-body">
    <div class="form-group">
        <label for="hospital">Pilih Rumah Sakit</label>
        <div class="input-group">
            <select name="hospital" id="hospital" class="form-control @error('hospital') is-invalid @enderror select2">
                <option selected disabled>Pilih Rumah Sakit</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name . ' - ' . $hospital->city }}</option>
                @endforeach
            </select>
            <span class="input-group-append">
                <a class="btn btn-teal bg-teal btn-flat" target="_blank" href="{{ route('hospitals.create') }}">+</a>
            </span>
            @error('hospital')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>

    @if (request()->segment(2) == 'plan')
        @include('visits.partials._add-visitplan-form-control2')
    @else
        @include('visits.partials._add-visit-form-control2')
    @endif

</div>
<!-- /.card-body -->

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
