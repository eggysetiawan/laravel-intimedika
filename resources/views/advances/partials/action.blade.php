<div class="dropright text-center">

    <a href="#" class="text-dark h3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu">

        <a href="{{ route('advances.show', $advance->slug) }}" class="dropdown-item"
            title="Lihat detail kunjungan ini.">
            <i class="far fa-eye nav-icon"></i>
            Detail
        </a>

        <a href="{{ route('advances.edit', $advance->slug) }}" class="dropdown-item">
            <i class="fas fa-edit nav-icon"></i>
            Edit
        </a>

    </div>

</div>
