<div class="dropright text-center">
    <a href="#" class="text-dark h5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu">
        <a href="{{ route('funnels.show', $funnel->slug) }}" class="dropdown-item"><i class="far fa-eye nav-icon"></i>
            Detail</a>
        <a href="{{ route('funnels.edit', $funnel->slug) }}" class="dropdown-item"><i
                class="fas fa-edit nav-icon"></i>
            Edit</a>
    </div>
</div>