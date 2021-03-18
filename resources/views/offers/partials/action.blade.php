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
                    <button type="button" class="dropdown-item" data-toggle="modal"
                        data-target="#approvePurchase{{ $offer->id }}">
                        <i class="far fa-check-circle nav-icon"></i>
                        Approve Purchase.
                    </button>
                    <button type="button" class="dropdown-item" data-toggle="modal"
                        data-target="#rejectPurchase{{ $offer->id }}">
                        <i class="far fa-times-circle nav-icon"></i>
                        Reject.</button>
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
    <div class="dropright text-center">
        <a href="#" class="text-dark h5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu">
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item" title="Lihat detail penawaran."><i
                    class="far fa-eye nav-icon"></i>
                Detail</a>
            <a href="{{ route('offers.edit', $offer->slug) }}" class="dropdown-item" title="Edit Penawaran"><i
                    class="fas fa-edit nav-icon"></i> Edit</a>

            @can('approval')
                {{-- approve button --}}
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#approveModal{{ $offer->id }}">
                    <i class="far fa-check-circle nav-icon"></i>
                    Approve.
                </button>
                {{-- hold button --}}
                @if ($offer->is_approved != 3)
                    {{-- 3 = On Hold --}}
                    <a href="{{ route('revisions.edit', $offer->slug) }}" class="dropdown-item">
                        <i class="far fa-pause-circle nav-icon"></i>
                        Hold.</a>
                @endif
                {{-- reject --}}
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#rejectModal{{ $offer->id }}">
                    <i class="far fa-times-circle nav-icon"></i>
                    Reject.</button>
            @endcan


            @can('view', $offer)
                <form action="{{ route('offers.destroy', $offer->slug) }}" method="POST">
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

@include('offers.modals.pin')
