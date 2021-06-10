<x-dropdown>
    <a href="{{ route('modalities.show', $modality->slug) }}" class="dropdown-item" title="Lihat detail Modality.">
        <i class="far fa-eye nav-icon"></i>
        Detail
    </a>
    <a href="{{ route('modalities.edit', $modality->slug) }}" class="dropdown-item" title="Edit detail alat ini."><i
            class="fas fa-edit nav-icon"></i> Edit</a>
</x-dropdown>
