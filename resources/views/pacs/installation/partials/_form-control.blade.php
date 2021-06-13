<div class="card-body">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-group">
                <label for="hospital">Pilih Rumah Sakit*</label>
                <div class="input-group">
                    @if (@$pacsInstallation->hospital->name)
                        <input type="text" disabled value="{{ $pacsInstallation->hospital->name }}"
                            class="form-control">
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
                <input type="date" name="handover_date" id="handover_date" class="form-control"
                    value="{{ old('handover_date') ?? date('Y-m-d', strtotime($pacsInstallation->handover_date ?? now())) }}">
            </div>

            {{-- Start Installation --}}
            <div class="form-group">
                <label for="start_installation_date">Tgl. Mulai Instalasi*</label>
                <input type="date" name="start_installation_date" id="start_installation_date"
                    max="{{ now()->addDays(3)->format('Y-m-d') }}" class="form-control"
                    value="{{ old('start_installation_date') ?? date('Y-m-d', strtotime($pacsInstallation->start_installation_date ?? now())) }}">
            </div>

            {{-- Training date --}}
            <div class="form-group">
                <label for="training_date">Tgl. Training</label>
                <input type="date" name="training_date" id="training_date" max="{{ now()->format('Y-m-d') }}"
                    class="form-control"
                    value="{{ old('training_date') ?? date('Y-m-d', strtotime($pacsInstallation->training_date ?? now())) }}">
            </div>

            {{-- Finish Installation --}}
            <div class="form-group">
                <label for="finish_installation_date">Tgl. Selesai Instalasi*</label>
                <input type="date" name="finish_installation_date" id="finish_installation_date"
                    max="{{ now()->format('Y-m-d') }}" class="form-control"
                    value="{{ old('finish_installation_date') ?? date('Y-m-d', strtotime($pacsInstallation->finish_installation_date ?? now())) }}">
            </div>

            {{-- Warranty Start --}}
            <div class="form-group">
                <label for="warranty_start">Tgl. Mulai Garansi*</label>
                <input type="date" name="warranty_start" id="warranty_start" class="form-control"
                    value="{{ old('warranty_start') ?? date('Y-m-d', strtotime($pacsInstallation->warranty_start ?? now())) }}">
            </div>

            {{-- Warranty End --}}
            <div class="form-group">
                <label for="warranty_end">Tgl. Akhir Garansi*</label>
                <input type="date" name="warranty_end" id="warranty_end" class="form-control"
                    value="{{ old('warranty_end') ?? date('Y-m-d', strtotime($pacsInstallation->warranty_end ?? now())) }}">
            </div>

            {{-- Engineer --}}
            @if ($create)
                <div class="form-group">
                    <label for="pacs_engineers">Intwid Engineer</label>

                    <select name="pacs_engineers[]" id="pacs_engineers"
                        class="form-control select2 js-example-basic-multiple" multiple>

                        @foreach ($engineers as $engineer)
                            <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                        @endforeach

                    </select>
                </div>
            @endif

            {{-- upload files --}}
            <div class="form-group">
                <label for="uploads">Upload File Berkas</label>
                <input type="file" name="img[]" id="img" class="form-control-file" multiple>
            </div>

            <div class="form-group mt-4">
                <label for="anydesk_server">Anydesk Server</label>
                <input type="text" name="anydesk_server" id="anydesk_server" class="form-control"
                    value="{{ old('anydesk_server') ?? $pacsInstallation->anydesk_server }}"
                    placeholder="Tuliskan alamat anydesk server disini..">
            </div>


        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="it_hospital_name">Nama IT RS*</label>
                <input type="text" name="it_hospital_name" id="it_hospital_name" class="form-control"
                    placeholder="Tuliskan nama IT Rumah Sakit.."
                    value="{{ old('it_hospital_name') ?? ($pacsInstallation->stakeholder->it_hospital_name ?? '') }}">
            </div>

            <div class="form-group">
                <label for="phone_it">No. HP IT RS</label>
                <input type="number" name="phone_it" id="phone_it" class="form-control" placeholder="cth: 08429589035"
                    value="{{ old('phone_it') ?? ($pacsInstallation->stakeholder->phone_it ?? '') }}">
            </div>

            <div class="form-group">
                <label for="email_it">Email IT RS</label>
                <input type="email" name="email_it" id="email_it" class="form-control" placeholder="example@mail.com"
                    value="{{ old('email_it') ?? ($pacsInstallation->stakeholder->email_it ?? '') }}">
            </div>

            <div class="form-group">
                <label for="radiographer_name">Nama Radiographer*</label>
                <input type="text" name="radiographer_name" id="radiographer_name" class="form-control"
                    placeholder="Tuliskan nama Radiographer Rumah Sakit.."
                    value="{{ old('radiographer_name') ?? ($pacsInstallation->stakeholder->radiographer_name ?? '') }}">
            </div>

            <div class="form-group">
                <label for="phone_radiographer">No. HP Radiographer</label>
                <input type="number" name="phone_radiographer" id="phone_radiographer" class="form-control"
                    placeholder="cth: 08947859"
                    value="{{ old('phone_radiographer') ?? ($pacsInstallation->stakeholder->phone_radiographer ?? '') }}">
            </div>

            <div class="form-group">
                <label for="email_radiographer">Email Radiographer</label>
                <input type="email" name="email_radiographer" id="email_radiographer" class="form-control"
                    placeholder="example@mail.com"
                    value="{{ old('email_radiographer') ?? ($pacsInstallation->stakeholder->email_radiographer ?? '') }}">
            </div>

            <div class="form-group">
                <label for="radiology_name">Nama Dokter Radiologi*</label>
                <input type="text" name="radiology_name" id="radiology_name" class="form-control"
                    placeholder="Tuliskan nama Dokter Radiologi.."
                    value="{{ old('radiology_name') ?? ($pacsInstallation->stakeholder->radiology_name ?? '') }}">
            </div>

            <div class="form-group">
                <label for="phone_radiology">No. HP Dokter Radiologi</label>
                <input type="number" name="phone_radiology" id="phone_radiology" class="form-control"
                    placeholder="cth: 0812395849"
                    value="{{ old('phone_radiology') ?? ($pacsInstallation->stakeholder->phone_radiology ?? '') }}">
            </div>

            <div class="form-group">
                <label for="email_radiology">Email Dokter Radiologi</label>
                <input type="email" name="email_radiology" id="email_radiology" class="form-control"
                    placeholder="example@mail.com"
                    value="{{ old('email_radiology') ?? ($pacsInstallation->stakeholder->email_radiology ?? '') }}">
            </div>

            <div class="form-group">
                <label for="anydesk_workstation">Anydesk Workstation</label>
                <input type="text" name="anydesk_workstation" id="anydesk_workstation" class="form-control"
                    value="{{ old('anydesk_workstation') ?? $pacsInstallation->anydesk_workstation }}"
                    placeholder="Tuliskan alamat anydesk workstation disini..">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="user_note">Keterangan</label>
        <div class="row justify-content-center">
            <textarea name="user_note" id="user_note" class="form-control" rows="3"
                placeholder="Tuliskan keterangan user..">{{ old('user_note') ?? ($pacsInstallation->stakeholder->user_note ?? '') }}</textarea>
        </div>
    </div>



</div>

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
