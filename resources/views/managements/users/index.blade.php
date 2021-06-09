@extends('layouts.app', ['title'=> 'Management User',
'caption'=> ''])

@section('breadcrumb')
    <li class="breadcrumb-item">Management User</li>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Management User
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-centered table-striped dt-responsive">
                        <thead>
                            <tr>
                                <td>#</td>
                                <th>Nama User</th>
                                <th>Role</th>
                                <th>Last Login IP</th>
                                <th>Last Login at</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{ join(' - ', array_unique($user->roles->pluck('name')->toArray())) }}
                                    </td>
                                    <td>{{ $user->last_login_ip }}</td>
                                    <td>{{ $user->last_login_time }}</td>
                                    <td>
                                        @include('managements.users.partials.action')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
