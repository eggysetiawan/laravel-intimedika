<div class="row justify-content-center">
    <div class="col-md-12">

        <x-testing-user></x-testing-user>

        <div class="form-group">
            <label for="destination">Tempat</label>
            <input type="text" name="destination" id="destination" class="form-control"
                placeholder="Tuliskan Rumah Sakit yang akan dikunjungi.."
                value="{{ old('destination') ?? $advance->destination }}">
        </div>

        <div class="form-group">
            <label for="objective">Tujuan</label>
            <textarea name="objective" class="form-control" id="objective" rows="2"
                placeholder="Tuliskan tujuan dilakukannya perjalanan..">{{ old('objective') ?? $advance->objective }}</textarea>
        </div>

    </div>
</div>


<div class="row justify-content-center">

    <div class="col-md-6">
        <label for="start_date">Tanggal Keberangkatan</label>
        <div class="form-group">
            <input type="date" name="start_date" id="start_date" class="form-control"
                value="{{ old('start_date') ?? date('Y-m-d', strtotime($advance->start_date)) }}">
        </div>
    </div>

    <div class="col-md-6">
        <label for="end_date">Tanggal Kepulangan</label>
        <div class="form-group">
            <input type="date" name="end_date" id="start_date" class="form-control"
                value="{{ old('end_date') ?? date('Y-m-d', strtotime($advance->end_date)) }}">
        </div>
    </div>

</div>

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="table-responsive">
            <table class="table table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Keperluan</th>
                        <th width="20%">Harga</th>
                        <th width="10%">Hari</th>
                        {{-- <th width="20%">Total Biaya</th> --}}
                        <th width="100%">Keterangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
</div>
