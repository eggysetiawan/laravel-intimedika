<!-- Button trigger modal -->
<p>
    {{ Str::limit($offer->progress->demo->description, 85, '...') }}
    @if (strlen($offer->progress->demo->description) > 85)
        <a href="{{ route('invoices.order', $offer->slug) }}">Read more</a>
    @endif
</p>
