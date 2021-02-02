@switch($offer->approve)
    @case(1)
    <div class="text-success">Approved!</div>
    @break
    @case(2)
    <div class="text-danger">Rejected!</div>
    @break
    @default
    @if (auth()
            ->user()
            ->isAdmin())
        <form action="{{ route('approval.offers', $offer->slug) }}">
            <div class="btn-group">
                <button class="btn btn-success btn-sm" name="approval" type="submit" value="1"
                    onclick="return confirm('apakah anda yakin?')">Approve.</button>
                <button class="btn btn-danger btn-sm" name="approval" value="2"
                    onclick="return confirm('apakah anda yakin?')">Reject.</button>
            </div>
        </form>
    @endif

@endswitch
