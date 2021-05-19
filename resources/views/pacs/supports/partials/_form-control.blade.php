<div class="card-body">

    <div class="form-group">
        <label for="pacs_installation">Rumah Sakit</label>
        <select name="pacs_installation" id="pacs_installation" class="form-control select2 select2-teal">
            @if ($edit)
                <option value="{{ $support->pacs_installation_id }}" selected>
                    {{ $support->installation->hospital->name }}
                </option>
            @else
                <option disabled selected>Pilih Rumah Sakit</option>
            @endif

        </select>
    </div>

    <div class="form-group">
        <label for="hospital_personel">Personel yang melapor</label>
        <input type="text" name="hospital_personel" id="reporter"
            value="{{ old('hospital_personel') ?? $support->hospital_personel }}" class="form-control"
            placeholder="Tuliskan nama pelapor..">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="form-group">
                <label for="report_date">Tanggal Lapor</label>
                <input type="date" name="report_date" id="report_date" class="form-control"
                    value="{{ old('report_date') ?? date('Y-m-d', strtotime($support->report_date ?? now()->format('Y-m-d'))) }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="report_time">Waktu Lapor</label>
                <input type="time" name="report_time" id="report_time" class="form-control"
                    value="{{ old('report_time') ?? date('H:i', strtotime($support->report_time ?? now()->format('H:i'))) }}">
            </div>
        </div>
    </div>



    <div class="form-group">
        <label for="problem">Permasalahan/Keluhan</label>
        <textarea name="problem" id="problem" rows="3" class="form-control"
            placeholder="Jelaskan permasalahan yang terjadi disini..">{{ old('problem') ?? $support->problem }}</textarea>
    </div>
    <div class="form-group">
        <label for="solve">Penyelesaian</label>
        <textarea name="solve" id="solve" rows="3" class="form-control"
            placeholder="Jelaskan permasalahan yang terjadi disini..">{{ old('solve') ?? $support->solve }}</textarea>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="form-group">
                <label for="solve_date">Tanggal Penyelesaian</label>
                <input type="date" name="solve_date" id="solve_date"
                    value="{{ old('report_date') ?? date('Y-m-d', strtotime($support->solve_date ?? now()->format('Y-m-d'))) }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="solve_time">Waktu Penyelesaian</label>
                <input type="time" name="solve_time" id="solve_time"
                    value="{{ old('report_date') ?? date('H:i', strtotime($support->solve_time ?? now()->format('H:i'))) }}"
                    class="form-control">
            </div>
        </div>
    </div>

    @empty($support)
        {{-- Engineer --}}
        <div class="form-group">
            <label for="pacs_engineers">Intwid Engineer</label>

            <select name="pacs_engineers[]" id="pacs_engineers" class="form-control select2 js-example-basic-multiple"
                multiple aria-placeholder="Pilih Engineer">
                @foreach ($engineers as $engineer)
                    <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach

            </select>
        </div>
    @endempty
</div>

<div class="card-footer">
    <x-button-submit>Submit</x-button-submit>
</div>
