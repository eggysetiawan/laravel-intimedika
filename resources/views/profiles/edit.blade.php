@extends('layouts.app', ['title'=>'Penawaran'])
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Daftar Penawaran</a></li>
    <li class="breadcrumb-item">Tambah</li>
@endsection

@section('content')
    <x-alert></x-alert>
    <x-card>
        <div class="card-header">
            <h3 class="card-title">Update Profile</h3>
        </div>
        <form method="POST" action="{{ route('profiles.update', auth()->user()->username) }}" enctype="multipart/form-data">
            <div class="card-body">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="img">Input Profile Picture</label>
                <input type="file" name="img" id="img" class="form-control @error('img') is-invalid @enderror">
                @error('img')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror

                @if($user->getFirstMediaUrl('profile'))
                    <img src="{{ $user->getFirstMediaUrl('profile') }}" alt="Foto Profil">
                @endif
            </div>

        </div>

        <div class="card-footer">
            <x-button-submit>Submit</x-button-submit>
        </div>
        </form>
    </x-card>
@endsection

@section('script')
    @include('customers.partials._select-customer')
@endsection
