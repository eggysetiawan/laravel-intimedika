<div class="dropright text-center">
    <a href="#" class="text-dark h3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu">
        <a href="{{ route('targets.edit', $target->slug) }}" class="dropdown-item"><i
                class="far fa-edit nav-icon"></i> Edit</a>
        <a href="{{ route('targets.destroy', $target->slug) }}" class="dropdown-item"><i
                class="far fa-trash-alt nav-icon"></i> Hapus</a>
    </div>

</div>
