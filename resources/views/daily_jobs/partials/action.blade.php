<div class="dropright text-center">
    <a href="#" class="text-dark h3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu">


        <a href="{{ route('daily_jobs.edit', $dailyJob->slug) }}" class="dropdown-item"
            title="Edit data Laporan harian ini."><i class="fas fa-edit nav-icon"></i>
            Edit</a>

        @if (!$dailyJob->deleted_at)

            <form action="{{ route('daily_jobs.destroy', $dailyJob->slug) }}" method="POST">
                @csrf
                @method('delete')

                <button type="submit" onclick="return confirm('anda yakin ingin menghapus?')" class="dropdown-item"
                    title="Hapus data kunjungan dari tabel"><i class="far fa-trash-alt nav-icon"></i>
                    Hapus</button>

            </form>
        @endif
    </div>

</div>
