@php
$progress = $offer->progress->progress;
switch ($progress) {
    case 30:
        $bar = 'bg-danger';
        break;
    case 50:
        $bar = 'bg-danger';
        break;
    case 70:
        $bar = 'bg-warning';
        break;
    case 85:
        $bar = 'bg-warning';
        break;
    case 90:
        $bar = 'bg-success';
        break;
    case 99:
        $bar = 'bg-success';
        break;

    default:
        $bar = 'bg-primary';

        break;
}
@endphp

@switch($offer->approve)
    @case(1)
    @if ($progress <= 99)
        <small>
            <div class="justify-content-center">
                <small class="text-secondary">{{ $offer->progress->status }}</small>
            </div>
        </small>
    @endif
    <div class="project_progress">
        <div class="progress progress-sm">
            <div class="progress-bar {{ $bar }}" role="progressbar" aria-volumenow="{{ $progress }}"
                aria-volumemin="0" aria-volumemax="100" style="width: {{ $progress }}%">
            </div>
        </div>
        <small>
            {{ $progress }}% Complete

            @if ($progress == 99)
                <a href="{{ route('invoices.order', $offer->slug) }}"> <small class="text-primary">Ready to
                        Approve</small></a>
            @endif
        </small>
    </div>
    @break
    @case(2)
    <span class="text-danger">has been rejected.</span>

    @break
    @default
    <span class="text-primary">Ready to Approve.</span>
@endswitch
