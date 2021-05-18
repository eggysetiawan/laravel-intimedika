@extends('layouts.app', ['title'=>'Penawaran'])


@section('content')


    <x-alert></x-alert>
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card card-teal card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#profile"
                                role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#password"
                                role="tab" aria-controls="password" aria-selected="true">Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                                aria-selected="false">Display Picture</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ route('profiles.update', $user->username) }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" readonly value="{{ $user->username }}" id="username"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" placeholder="Masukkan nama akun.."
                                        value="{{ $user->name }}" id="name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="initial">Inisial</label>
                                    <input type="text" name="initial" placeholder="Maksimal 3 huruf.." id="initial"
                                        maxlength="3" value="{{ $user->initial }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="position">Posisi/Jabatan</label>
                                    <input type="text" name="position" placeholder="Masukan jabatan anda.."
                                        value="{{ $user->position }}" id="position" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Nomor HP</label>
                                    <input type="number" name="phone" id="phone" placeholder="Masukan nomor telfon anda..."
                                        value="{{ $user->phone }}" class="form-control phone">
                                </div>

                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <input type="email" name="email" placeholder="Masukan email anda.."
                                        value="{{ $user->email }}" id="email" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="city">Daerah Asal</label>
                                    <select name="city" id="city" class="form-control select2">
                                        @isset($user->city)
                                            <option selected value="{{ $user->city }}">{{ $user->city }}</option>
                                            @foreach ($cities as $city)
                                                @if ($user->city != $city['nama'])
                                                    <option value="{{ $city['nama'] }}">{{ $city['nama'] }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option selected disabled>Pilih Kota</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city['nama'] }}">{{ $city['nama'] }}</option>
                                            @endforeach
                                        @endisset

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" id="address" rows="3"
                                        placeholder="Masukan detail alamat anda.."
                                        class="form-control">{{ $user->address ?? '' }}</textarea></textarea>
                                </div>

                                <x-button-submit>Update Profile</x-button-submit>

                            </form>
                        </div>
                        <div class="tab-pane fade show" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <form action="{{ route('profiles.password', $user->username) }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="password_old">Password Lama</label>
                                    <input type="password" name="password_old" id="password_old" class="form-control"
                                        placeholder="Masukkan password..">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukkan password baru..">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="Masukan ulang password baru..">
                                </div>

                                <x-button-submit>Update Password</x-button-submit>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-three-profile-tab">
                            <form method="POST" action="{{ route('profiles.picture', $user->username) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="img">Input Profile Picture</label>
                                    <input style="padding: 3px;" type="file" name="img" id="img"
                                        class="form-control-file @error('img') is-invalid @enderror">
                                    @error('img')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    @if ($user->getFirstMediaUrl('profile'))
                                        <br><img src="{{ $user->getFirstMediaUrl('profile') }}" width="100"
                                            alt="Foto Profil">
                                    @endif
                                </div>


                                <x-button-submit>Submit</x-button-submit>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <x-card>
        <div class="card-header">
            <h3 class="card-title">Update Profile</h3>
        </div>
        <form method="POST" action="{{ route('profiles.update', auth()->user()->username) }}"
            enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="img">Input Profile Picture</label>
                    <input style="padding: 3px;" type="file" name="img" id="img"
                        class="form-control @error('img') is-invalid @enderror">
                    @error('img')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror

                    @if ($user->getFirstMediaUrl('profile'))
                        <br><img src="{{ $user->getFirstMediaUrl('profile') }}" width="100" alt="Foto Profil">
                    @endif
                </div>

            </div>

            <div class="card-footer">
                <x-button-submit>Submit</x-button-submit>
            </div>
        </form>
    </x-card> --}}
@endsection

@section('script')
    @include('customers.partials._select-customer')
@endsection
