<div class="dropright text-center">
    <a href="#" class="text-dark h3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu">


        <a href="{{ route('visitplan.edit', $pacsSupport->slug) }}" class="dropdown-item"
            title="Edit data Rencana Kunjungan ini."><i class="fas fa-edit nav-icon"></i>
            Edit</a>

        @if (!$pacsSupport->deleted_at)

            <form action="{{ route('pacs_supports.destroy', $pacsSupport->slug) }}" method="POST">
                @csrf
                @method('delete')

                <button type="submit" onclick="return confirm('anda yakin ingin menghapus?')" class="dropdown-item"
                    title="Hapus data kunjungan dari tabel"><i class="far fa-trash-alt nav-icon"></i>
                    Hapus</button>

            </form>
        @endif
    </div>

</div>
