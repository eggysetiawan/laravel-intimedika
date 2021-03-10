@php
$progress = $offer->progress->progress;
switch ($progress) {
    case 30:
        $bar = 'bg-danger';
        break;
    case 50:
        $bar = 'bg-orange';
        break;
    case 70:
        $bar = 'bg-warning';
        break;
    case 85:
        $bar = 'bg-warning';
        break;
    case 90:
        $bar = 'bg-primary';
        break;
    case 99:
        $bar = 'bg-primary';
        break;

    default:
        $bar = 'bg-success';

        break;
}
@endphp

@switch($offer->is_approved)
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
            <div class="progress-bar {{ $bar }} progress-bar-striped" role="progressbar"
                aria-volumenow="{{ $progress }}" aria-volumemin="0" aria-volumemax="100"
                style="width: {{ $progress }}%">
            </div>
        </div>
        <small>
            {{ $progress }}% Completed.

            @if ($progress == 99)
                <a href="{{ route('invoices.toOrder', $offer->slug) }}"> <small class="badge badge-warning text-white"
                        title="Approve Penawaran">Ready
                        to
                        Approve</small></a>
            @endif
        </small>
    </div>
    @break

    @case(2)
    <span class="badge badge-danger text-white">has been rejected.</span>
    @break

    @case(3)
    <span class="badge badge-secondary text-white">On Hold.</span>

    @break

    @default
    <span class="badge badge-warning text-white">Ready to Approve.</span>
@endswitch
