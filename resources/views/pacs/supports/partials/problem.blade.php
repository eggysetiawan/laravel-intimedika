{{ Str::limit($pacsSupport->problem, 50, '...') }}
@if (strlen($pacsSupport->problem) >= 50)
    <a href="{{ route('pacs_supports.show', $pacsSupport->slug) }}">Read More</a>
@endif
