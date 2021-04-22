<div class="card-body">

    <x-testing-user></x-testing-user>

    @include('offers.partials.head')

    @include('offers.partials.foot')

</div>
<!-- /.card-body -->

<div class="card-footer">
    <x-button-submit>{{ $submit ?? 'Update' }}</x-button-submit>
</div>
