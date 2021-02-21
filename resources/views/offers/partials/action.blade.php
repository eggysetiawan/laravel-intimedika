@switch($offer->is_approved)
    @case(1)
    <div class="dropright text-center">
        <a href="#" class="text-dark h5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu">
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item"><i class="far fa-eye"></i>
                Detail</a>

            @can('approval')
                @if ($offer->progress->progress == 99)
                    <form action="{{ route('approval.progress', $offer->slug) }}" method="POST"
                        class=" justify-content-center">
                        @csrf
                        @method('patch')
                        <button class="dropdown-item" name="approval" type="submit" value="1"
                            onclick="return confirm('apakah anda yakin?')"><i class="far fa-check-circle"></i>
                            Approve PO.</button>
                        <button class="dropdown-item" name="approval" value="2"
                            onclick="return confirm('apakah anda yakin?')"><i class="far fa-times-circle"></i>
                            Reject PO.</button>
                    </form>
                @endif
            @endcan

            @if ($offer->progress->progress < 99)
                @if (auth()->id() != 13) <a
                href="{{ route('progresses.create', $offer->slug) }}" class="dropdown-item"><i
                class="far fa-edit"></i>Update PO </a> @endif
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
            @can('view', $offer)
                <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item"><i class="far fa-eye"></i>
                    Detail</a>
            @endcan
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
            <a href="{{ route('invoices.order', $offer->slug) }}" class="dropdown-item"><i class="far fa-eye"></i>
                Detail</a>

            @can('approval')
                <form action="{{ route('approval.offers', $offer->slug) }}" method="POST" class=" justify-content-center">
                    @csrf
                    @method('patch')
                    <button class="dropdown-item" name="approval" type="submit" value="1"
                        onclick="return confirm('apakah anda yakin?')"><i class="far fa-check-circle"></i>
                        Approve.</button>
                    <button class="dropdown-item" name="approval" value="2" onclick="return confirm('apakah anda yakin?')"><i
                            class="far fa-times-circle"></i>
                        Reject.</button>
                </form>
            @endcan


            @can('view', $offer)
                <form action="{{ route('offers.delete', $offer->slug) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="dropdown-item" name="approval" type="submit"
                        onclick="return confirm('apakah anda yakin?')"><i class="far fa-trash-alt"></i>
                        Delete</button>
                </form>
            @endcan
        </div>
    </div>


@endswitch
