<x-dropdown>
    @if (request()->segment(1) == 'visits')
        <a href="{{ route('visits.show', $visit->slug) }}" class="dropdown-item"
            title="Lihat detail kunjungan ini."><i class="far fa-eye nav-icon"></i>
            Detail</a>
    @endif

    @hasrole('sales|superadmin')
    @if (request()->segment(1) == 'visitplan')
        <a href="{{ route('arrival.edit', $visit->slug) }}" class="dropdown-item"
            title="Klik disini untuk melengkapi data kunjungan harian apabila anda telah melakukan kunjungan ke Rumah sakit ini."><i
                class="fas fa-plane-departure nav-icon"></i>
            Lakukan Kunjungan</a>

        <a href="{{ route('visitplan.edit', $visit->slug) }}" class="dropdown-item"
            title="Edit data Rencana Kunjungan ini."><i class="fas fa-edit nav-icon"></i>
            Edit</a>
    @endif

    @if (!$visit->deleted_at)

        <form action="{{ route('visits.destroy', $visit->slug) }}" method="POST">
            @csrf
            @method('delete')

            <button type="submit" onclick="return confirm('anda yakin ingin menghapus?')" class="dropdown-item"
                title="Hapus data kunjungan dari tabel"><i class="far fa-trash-alt nav-icon"></i>
                Hapus</button>

        </form>
    @else
        <a href="{{ route('visits.restore', $visit->slug) }}" class="dropdown-item"
            onclick="return confirm('apakah anda yakin?')"><i class="fas fa-trash-restore nav-icon"></i>
            Restore</a>
    @endif
    @endhasrole
</x-dropdown>
