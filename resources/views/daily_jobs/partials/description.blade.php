{{ Str::limit($dailyJob->description, 50, '...') }}
@if (strlen($dailyJob->description) >= 50)
    <a href="#">Read More</a>
@endif
