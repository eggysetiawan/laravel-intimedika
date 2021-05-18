@extends('layouts.app', ['title'=>'Penawaran'])


@section('content')
    <x-alert></x-alert>
    <div class="col-10 col-sm-8 col-lg-4">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                            href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                            aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                            href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                            aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                            href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                            aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                            href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings"
                            aria-selected="false">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                        aria-labelledby="custom-tabs-three-home-tab">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui
                        molestie,
                        sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna,
                        mollis
                        auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper
                        felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                        turpis
                        egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim
                        sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl,
                        id
                        tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit,
                        condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-three-profile-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula
                        tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas
                        sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus.
                        Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque
                        diam.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-three-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id
                        mi
                        placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique
                        nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis
                        urna
                        a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non
                        luctus
                        efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex
                        vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur
                        eget
                        sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac,
                        ornare
                        sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod
                        molestie
                        tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec
                        pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl
                        commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet
                        facilisis.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-card>
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
    </x-card>
@endsection

@section('script')
    @include('customers.partials._select-customer')
@endsection
