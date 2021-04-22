<div class="card-body">

    <x-testing-user></x-testing-user>

    {{-- only appears when create offer --}}
    @empty($offer->offer_no)
        @include('offers.partials.head')
    @endempty

    @include('offers.partials.foot')

</div>
<!-- /.card-body -->

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
