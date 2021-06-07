<x-dropdown>
    <a href="{{ route('hospitals.edit', ['hospital' => $hospital->slug]) }}" class="dropdown-item"
        title="Ubah data Rumah Sakit"><i class="fas fa-edit nav-icon"></i> Edit</a>

    @unlessrole('director')
    <form action="{{ route('hospitals.destroy', $hospital->slug) }}" method="post">
        @csrf
        @method('delete')
        <button class="dropdown-item" type="submit" onclick="return confirm('Are you sure?')"
            title="Hapus Rumah Sakit dari tabel"><i class="far fa-trash-alt nav-icon"></i> Hapus</button>
    </form>
    @endunlessrole
</x-dropdown>
