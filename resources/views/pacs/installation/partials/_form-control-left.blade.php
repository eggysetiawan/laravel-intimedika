<div class="card-body">


    <div class="form-group">
        <label for="hospital">Pilih Rumah Sakit</label>
        <div class="input-group">
            {{-- @if (@$customer->hospitals->first()->name)
                    <input type="text" disabled value="{{ $customer->hospitals->first()->name }}" class="form-control">
                @else --}}
            <x-hospitals></x-hospitals>
            <span class="input-group-append">
                <a class="btn btn-teal bg-teal btn-flat" target="_blank" href="{{ route('hospitals.create') }}"
                    title="Rumah Sakit belum ada dalam daftar? klik disini untuk menambahkan.">+</a>
            </span>
            @error('hospital')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
            {{-- @endif --}}

        </div>
    </div>

    <div class="form-group">
        <label for="start_installation_date">Tgl. Mulai Instalasi</label>
        <input type="date" name="start_installation_date" id="start_installation_date"
            max="{{ now()->addDays(3)->format('Y-m-d') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="training_date">Tgl. Training</label>
        <input type="date" name="training_date" id="training_date" max="{{ now()->format('Y-m-d') }}"
            class="form-control">
    </div>


    <div class="form-group">
        <label for="end_installation_date">Tgl. Selesai Instalasi</label>
        <input type="date" name="end_installation_date" id="end_installation_date" max="{{ now()->format('Y-m-d') }}"
            class="form-control">
    </div>

    <div class="form-group">
        <label for="warranty_start">Tgl. Mulai Garansi</label>
        <input type="date" name="warranty_start" id="warranty_start" class="form-control">
    </div>

    <div class="form-group">
        <label for="warranty_end">Tgl. Akhir Garansi</label>
        <input type="date" name="warranty_end" id="warranty_end" class="form-control">
    </div>

    @for ($i = 1; $i <= 3; $i++)
        <div class="form-group">
            <label for="pacs_engineer">Intwid Engineer {{ $i }}</label>

            <select name="pacs_engineer" id="pacs_engineer" class="form-control select2">

                <option value="" selected disabled>Pilih Engineer</option>
                @foreach ($engineers as $engineer)
                    <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach

            </select>
        </div>
    @endfor



</div>
