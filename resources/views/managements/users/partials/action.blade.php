<x-dropdown>
    <a href="#!" data-toggle="modal" data-target="#addRole">Add Role</a>
</x-dropdown>
<!-- Modal -->
<div class="modal fade" id="addRole" tabindex="-1" aria-labelledby="addRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleLabel">Add Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('managements.update', $user->username) }}">
                <div class="modal-body">
                    <select name="role" id="role" class="form-control">
                        <option disabled selected>Pilih Role</option>
                        {{-- @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role) }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-teal">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
