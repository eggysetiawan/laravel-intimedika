@role('superadmin')
<div class="form-group">
    <label for="user">Pilih User testing</label>
    <select name="user" id="user" class="form-control select2">
        <option value="{{ auth()->id() }}">{{ auth()->user()->name }}</option>
        @foreach ($users as $user)
            @if (auth()->id() != $user->id)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endif

        @endforeach
    </select>
</div>
@endrole
