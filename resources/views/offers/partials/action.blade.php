@switch($offer->is_approved)
    @case(1)
    <div class="dropright text-center">
        <a href="#" class="text-dark h5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu">
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item" title="Lihat detail penawaran."><i
                    class="far fa-eye nav-icon"></i>
                Detail</a>

            @can('approval')
                @if ($offer->progress->progress == 99)
                    <form action="{{ route('approval.progress', $offer->slug) }}" method="POST"
                        class=" justify-content-center">
                        @csrf
                        @method('patch')
                        <button class="dropdown-item" name="approval" type="submit" value="1"
                            onclick="return confirm('apakah anda yakin?')" title="Setujui PO"><i
                                class="far fa-check-circle nav-icon"></i>
                            Approve PO.</button>
                        <button class="dropdown-item" name="approval" value="2" onclick="return confirm('apakah anda yakin?')"
                            title="Tolak PO"><i class="far fa-times-circle nav-icon"></i>
                            Reject PO.</button>
                    </form>
                @endif
            @endcan

            @if ($offer->progress->progress <= 99)
                @if (auth()->id() != 13) <a
                href="{{ route('progresses.create', $offer->slug) }}" class="dropdown-item"
                title="Update Purchase Order"><i
                class="far fa-edit nav-icon"></i> Update Purchase </a> @endif
            @endif


        </div>
    </div>
    @break
    @case(2)
    <div class="dropright text-center">
        <a href="#" class="text-dark h5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu">
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item" title="Lihat detail penawaran."><i
                    class="far fa-eye nav-icon"></i> Detail</a>
        </div>
    </div>
    @break
    @default


    <!-- Default dropright button -->
    <div class="dropright text-center">
        <a href="#" class="text-dark h5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu">
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item" title="Lihat detail penawaran."><i
                    class="far fa-eye nav-icon"></i>
                Detail</a>

            @can('approval')
                <form action="{{ route('approval.offers', $offer->slug) }}" method="POST" class=" justify-content-center">
                    @csrf
                    @method('patch')
                    <button class="dropdown-item" name="approval" type="submit" value="1"
                        onclick="return confirm('apakah anda yakin?')" title="Setujui Penawaran."><i
                            class="far fa-check-circle nav-icon"></i>
                        Approve.</button>
                    <button class="dropdown-item" name="approval" value="2" onclick="return confirm('apakah anda yakin?')"
                        title="Tolak penawaran."><i class="far fa-times-circle nav-icon"></i>
                        Reject.</button>
                </form>
            @endcan


            @can('view', $offer)
                <form action="{{ route('offers.delete', $offer->slug) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="dropdown-item" name="approval" type="submit" onclick="return confirm('apakah anda yakin?')"
                        title="Hapus Penawaran."><i class="far fa-trash-alt nav-icon"></i>
                        Delete</button>
                </form>
            @endcan
        </div>
    </div>


@endswitch
