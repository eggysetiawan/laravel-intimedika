<x-dropdown>
    <a href="{{ route('inventories.edit', $inventory->slug) }}" title="Edit detail barang ini."
        style="color: black;"><i class="fas fa-edit nav-icon"></i> Edit</a>

    <form action="{{ route('inventories.destroy', $inventory->slug) }}" class="inline" method="post">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('anda yakin ingin menghapus?')" class="dropdown-item"
            title="Hapus data barang dari tabel"><i class="far fa-trash-alt nav-icon"></i>
            Hapus</button>
    </form>
</x-dropdown>
