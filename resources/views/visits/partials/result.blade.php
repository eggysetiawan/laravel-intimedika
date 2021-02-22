{{ Str::limit($visit->result, 50) }}
<div><a href="{{ route('visits.show', $visit->slug, '...') }}">Read More</a></div>
