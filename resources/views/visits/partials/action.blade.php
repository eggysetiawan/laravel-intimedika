<div class="dropright text-center">
    <a href="#" class="text-dark h5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu">
        @if (!request()->segment(2))
            <a href="{{ route('visits.show', $visit->slug) }}" class="dropdown-item"><i
                    class="far fa-eye nav-icon"></i>
                Detail</a>
        @endif
        @if (!$visit->deleted_at)
            <form action="{{ route('visits.delete', $visit->slug) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" onclick="return confirm('anda yakin ingin menghapus?')" class="dropdown-item"><i
                        class="far fa-trash-alt nav-icon"></i>
                    Hapus</button>
            </form>
        @else
            <a href="{{ route('visits.restore', $visit->slug) }}" class="dropdown-item"
                onclick="return confirm('apakah anda yakin?')"><i class="fas fa-trash-restore nav-icon"></i>
                Restore</a>
        @endif
        @if (request()->segment(2) == 'plan')
            <a href="{{ route('visitplan.edit', $visit->slug) }}" class="dropdown-item"><i
                    class="fas fa-plane nav-icon"></i>
                Update Kunjungan</a>
        @endif
    </div>

</div>