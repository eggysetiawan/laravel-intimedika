<x-dropdown>
    <a href="{{ route('funnels.show', $funnel->slug) }}" class="dropdown-item" title="Lihat detail funnel ini.">
        <i class="far fa-eye nav-icon"></i>
        Detail
    </a>

    <a href="{{ route('funnels.edit', $funnel->slug) }}" class="dropdown-item" title="Edit data funnel ini.">
        <i class="fas fa-edit nav-icon"></i>
        Edit
    </a>

    @if ($funnel->progress < 100)
        <a href="{{ route('offerfunnel.edit', $funnel->slug) }}" class="dropdown-item"
            title="Buat penawaran dari funnel ini.">
            <i class="fab fa-buffer nav-icon"></i>
            Buat Penawaran
        </a>
    @endif
</x-dropdown>
