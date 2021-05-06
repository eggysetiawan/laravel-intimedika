<div class="dropright text-center">
    <a href="#" class="text-dark h3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>

    <div class="dropdown-menu">
        <a href="{{ route('inventories.edit', $inventory->slug) }}" class="dropdown-item"
            title="Edit detail barang ini."><i class="fas fa-edit nav-icon"></i> Edit</a>

        <form action="{{ route('inventories.destroy', $inventory->slug) }}" class="inline" method="post">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('anda yakin ingin menghapus?')" class="dropdown-item"
                title="Hapus data barang dari tabel"><i class="far fa-trash-alt nav-icon"></i>
                Hapus</button>
        </form>
    </div>

</div>
