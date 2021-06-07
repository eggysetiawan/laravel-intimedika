<x-dropdown>
    <a href="{{ route('pacs_installations.edit', $pacsInstallation->slug) }}" class="dropdown-item"
        title="Edit data Rencana Kunjungan ini."><i class="fas fa-edit nav-icon"></i>
        Edit</a>

    @if (!$pacsInstallation->deleted_at)

        <form action="{{ route('pacs_installations.destroy', $pacsInstallation->slug) }}" method="POST">
            @csrf
            @method('delete')

            <button type="submit" onclick="return confirm('anda yakin ingin menghapus?')" class="dropdown-item"
                title="Hapus data kunjungan dari tabel"><i class="far fa-trash-alt nav-icon"></i>
                Hapus</button>

        </form>
    @endif
</x-dropdown>
