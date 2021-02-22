@include('layouts.head')
{{ 'No. Penawaran' . $offer->offer_no }}

<a href="{{ route('invoices.order', $offer->slug) }}" class="btn btn-secondary form-control-plaintext">Lihat
    Penawaran</a>

@include('layouts.script-footer')
