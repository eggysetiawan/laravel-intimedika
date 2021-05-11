{{ Str::limit($pacsSupport->solve, 50, '...') }}
@if (strlen($pacsSupport->solve) >= 50)
    <a href="{{ route('pacs_supports.show', $pacsSupport->slug) }}">Read More</a>
@endif
