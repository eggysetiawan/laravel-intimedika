@switch($offer->approve)
    @case(1)
    <div class="text-success">Approved!</div>
    @if (auth()->id() != 13)
        <a href="{{ route('progresses.create', $offer->slug) }}"><button
                class="badge bg-gradient-gray-dark badge-sm rounded-sm">Input
                PO</button></a>
    @endif
    @break
    @case(2)
    <div class="text-danger">Rejected!</div>
    @break
    @default
    @if (auth()
            ->user()
            ->isAdmin())
        <form action="{{ route('approval.offers', $offer->slug) }}" method="POST">
            @csrf
            <div class="btn-group">
                <button class="btn btn-success btn-sm" name="approval" type="submit" value="1"
                    onclick="return confirm('apakah anda yakin?')">Approve.</button>
                <a href="{{ route('invoices.order', $offer->slug) }}" class="btn btn-info btn-sm">Detail</a>
                <button class="btn btn-danger btn-sm" name="approval" value="2"
                    onclick="return confirm('apakah anda yakin?')">Reject.</button>
            </div>
        </form>
    @endif

@endswitch
