@extends('layouts.app', ['title' => 'Kunjungan Terjadwal'])


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('visitplan.index') }}">Rencana Kunjungan Harian</a></li>
    <li class="breadcrumb-item">Kunjungan Terjadwal</li>
@endsection

@section('content')
    <x-card>
        <div class="card-header">
            <h3 class="card-title">
                Kunjungan Terjadwal
                <small>
                    <small>
                        {{ date('j/n/Y', strtotime($visit->plan->date)) }}
                    </small>
                </small>
            </h3>
        </div>

        <form role="form" method="post" action="{{ route('arrival.update', $visit->slug) }}" novalidate
            enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="hospital">Rumah Sakit</label>
                    <input type="text" class="form-control" id="hospital" disabled
                        value="{{ $visit->customer->hospitals->first()->name }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama Customer</label>
                            <input type="text" class="form-control" id="name" disabled
                                value="{{ $visit->customer->name }}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Hp/Telp.</label>
                            <input type="text" class="form-control" id="name" disabled
                                value="{{ $visit->customer->mobile }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="role">Jabatan</label>
                    <input type="text" name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                        value="{{ old('role') }}" placeholder="Tuliskan jabatan..">
                </div>
                <div class="form-group">
                    <label for="request">Permintaan</label>
                    <textarea name="request" id="request" class="form-control @error('request') is-invalid @enderror"
                        cols="30" rows="4" placeholder="Tuliskan Hasil Kunjungan Harian">{{ old('request') }}</textarea>
                    @error('request')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="result">Hasil Kunjungan</label>
                    <textarea name="result" id="result" class="form-control @error('result') is-invalid @enderror" cols="30"
                        rows="10" placeholder="Tuliskan Hasil Kunjungan Harian">{{ old('result') }}</textarea>
                    @error('result')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="file" name="img" id="img" class="form-control-file @error('img') is-invalid @enderror">
                    @error('img')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-button-submit>Submit</x-button-submit>
            </div>

        </form>
    </x-card>
@endsection
