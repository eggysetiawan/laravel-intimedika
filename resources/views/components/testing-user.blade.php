@role('superadmin')
<div class="form-group">
    <label for="user">Pilih User testing</label>
    <select name="user" id="user" class="form-control">
        <option value="{{ auth()->id() }}">{{ auth()->user()->name }}</option>
        @foreach ($users as $user)
            @if (auth()->id() != $user->id)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endif

        @endforeach
    </select>
</div>

{{-- @section('script')
    <script>
        $(document).ready(function() {
            window.initSelectUserDrop = () => {
                $('#user').select2({
                    placeholder: 'Pilih User',
                    allowClear: true,
                });
            }
            initSelectUserDrop();
            // $('#hospital').on('change', function(e) {
            //     livewire.emit('selectedHospitalItem', e.target.value)
            // });
            window.livewire.on('select2', () => {
                initSelectUserDrop();
            });

        });

    </script>
@endsection --}}
@endrole
