<x-dropdown>
    <a href="#!" data-toggle="modal" data-target="#addRole-{{ $user->username }}">Add Role</a>
    @if ($user->roles->count() > 1)
        <a href="#!" data-toggle="modal" data-target="#removeRole-{{ $user->username }}">Remove Role</a>
    @endif
</x-dropdown>
<!-- Add Role Modal -->
<div class="modal fade" id="addRole-{{ $user->username }}" tabindex="-1" aria-labelledby="addRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleLabel">Add Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('managements.update', $user->username) }}" method="post">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <dt>Role yang dimiliki saat ini</dt>
                    <ol>
                        @foreach ($user->roles as $userRole)
                            <li>
                                {{ ucfirst($userRole->name) }}
                            </li>
                        @endforeach
                    </ol>
                    <hr>
                    <label for="roles">Tambah Role</label>
                    <select name="roles[]" id="roles"
                        class="form-control select2 js-example-basic-multiple @error('roles') form-control @enderror"
                        multiple>

                        <option disabled selected>Pilih Role</option>

                        @foreach ($roles as $role)
                            @if (!in_array($role->name, $user->roles->pluck('name')->toArray()))
                                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('roles')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-teal">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Add Role Modal -->
<div class="modal fade" id="removeRole-{{ $user->username }}" tabindex="-1" aria-labelledby="removeRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleLabel">{{ $user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('managements.removeRole', $user->username) }}" method="post">
                @csrf
                @method('patch')
                <div class="modal-body">

                    <label for="roles">Hapus Role</label>
                    <select name="roles" id="roles" class="form-control select2 @error('roles') form-control @enderror">
                        <option disabled selected>Pilih Role</option>

                        @foreach ($user->roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('roles')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-teal" @if ($user->roles->count() <= 1) disabled title="Role tidak bisa dihapus jika user hanya memiliki 1 role." @endif>Remove</button>
                </div>
            </form>

        </div>
    </div>
</div>
