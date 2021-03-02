@if ($visit->is_visited == 1)
    <a href="{{ route('visits.show', $visit->slug) }}" class="badge badge-success text-white" target="_blank">sudah
        dikunjungi.</a>
@endif
