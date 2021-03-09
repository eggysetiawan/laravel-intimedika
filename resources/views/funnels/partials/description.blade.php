<p>{{ Str::limit($funnel->description, 20, '...') }}@if (strlen($funnel->description) > 20) <a href="#">Readmore</a> @endif
</p>
