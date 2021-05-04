<div class="card-body">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-group">
                <label for="hospital">Pilih Rumah Sakit*</label>
                <div class="input-group">
                    @if (@$pacs->hospital->name)
                        <input type="text" disabled value="{{ $pacs->hospital->name }}" class="form-control">
                    @else
                        <x-hospitals></x-hospitals>
                        <span class="input-group-append">
                            <a class="btn btn-teal bg-teal btn-flat" target="_blank"
                                href="{{ route('hospitals.create') }}"
                                title="Rumah Sakit belum ada dalam daftar? klik disini untuk menambahkan.">+</a>
                        </span>
                        @error('hospital')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    @endif

                </div>
            </div>

            {{-- Handover/serah terima --}}
            <div class="form-group">
                <label for="handover_date">Tgl. Serah terima</label>
                <input type="datetime-local" name="handover_date" id="handover_date" class="form-control">
            </div>


            {{-- Start Installation --}}
            <div class="form-group">
                <label for="start_installation_date">Tgl. Mulai Instalasi*</label>
                <input type="datetime-local" name="start_installation_date" id="start_installation_date"
                    max="{{ now()->addDays(3)->format('Y-m-d') }}" class="form-control">
            </div>

            {{-- Training date --}}
            <div class="form-group">
                <label for="training_date">Tgl. Training</label>
                <input type="datetime-local" name="training_date" id="training_date"
                    max="{{ now()->format('Y-m-d') }}" class="form-control">
            </div>

            {{-- Finish Installation --}}
            <div class="form-group">
                <label for="finish_installation_date">Tgl. Selesai Instalasi*</label>
                <input type="datetime-local" name="finish_installation_date" id="finish_installation_date"
                    max="{{ now()->format('Y-m-d') }}" class="form-control">
            </div>

            {{-- Warranty Start --}}
            <div class="form-group">
                <label for="warranty_start">Tgl. Mulai Garansi*</label>
                <input type="date" name="warranty_start" id="warranty_start" class="form-control">
            </div>

            {{-- Warranty End --}}
            <div class="form-group">
                <label for="warranty_end">Tgl. Akhir Garansi*</label>
                <input type="date" name="warranty_end" id="warranty_end" class="form-control">
            </div>

            {{-- Engineer --}}
            <div class="form-group">
                <label for="pacs_engineers">Intwid Engineer</label>

                <select name="pacs_engineers[]" id="pacs_engineers"
                    class="form-control select2 js-example-basic-multiple" multiple>

                    @foreach ($engineers as $engineer)
                        <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                    @endforeach

                </select>
            </div>

            {{-- upload files --}}
            <div class="form-group">
                <label for="uploads">Upload File Berkas*</label>
                <input type="file" name="img" id="img" class="form-control-file">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="it_hospital_name">Nama IT RS*</label>
                <input type="text" name="it_hospital_name" id="it_hospital_name" class="form-control"
                    placeholder="Tuliskan nama IT Rumah Sakit..">
            </div>

            <div class="form-group">
                <label for="phone_it">No. HP IT RS</label>
                <input type="number" name="phone_it" id="phone_it" class="form-control" placeholder="cth: 08429589035">
            </div>

            <div class="form-group">
                <label for="email_it">Email IT RS</label>
                <input type="email" name="email_it" id="email_it" class="form-control" placeholder="example@mail.com">
            </div>

            <div class="form-group">
                <label for="radiographer_name">Nama Radiographer*</label>
                <input type="text" name="radiographer_name" id="radiographer_name" class="form-control"
                    placeholder="Tuliskan nama Radiographer Rumah Sakit..">
            </div>

            <div class="form-group">
                <label for="phone_radiographer">No. HP Radiographer</label>
                <input type="number" name="phone_radiographer" id="phone_radiographer" class="form-control"
                    placeholder="cth: 08947859">
            </div>

            <div class="form-group">
                <label for="email_radiographer">Email Radiographer</label>
                <input type="email" name="email_radiographer" id="email_radiographer" class="form-control"
                    placeholder="example@mail.com">
            </div>

            <div class="form-group">
                <label for="radiology_name">Nama Dokter Radiologi*</label>
                <input type="text" name="radiology_name" id="radiology_name" class="form-control"
                    placeholder="Tuliskan nama Dokter Radiologi..">
            </div>

            <div class="form-group">
                <label for="phone_radiology">No. HP Dokter Radiologi</label>
                <input type="number" name="phone_radiology" id="phone_radiology" class="form-control"
                    placeholder="cth: 0812395849">
            </div>

            <div class="form-group">
                <label for="email_radiology">Email Dokter Radiologi</label>
                <input type="email" name="email_radiology" id="email_radiology" class="form-control"
                    placeholder="example@mail.com">
            </div>

        </div>

    </div>
    <div class="form-group">
        <label for="user_note">Keterangan</label>
        <div class="row justify-content-center">
            <textarea name="user_note" id="user_note" class="form-control" rows="3"
                placeholder="Tuliskan keterangan user.."></textarea>
        </div>
    </div>



</div>

<div class="card-footer">
    <x-button-submit>Submit</x-button-submit>
</div>
