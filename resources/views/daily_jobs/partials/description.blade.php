{{ Str::limit($dailyJob->description, 50, '...') }}
@if (strlen($dailyJob->description) >= 50)
    <a href="{{ route('daily_jobs.show', $dailyJob->slug) }}">Read More</a>
@endif
