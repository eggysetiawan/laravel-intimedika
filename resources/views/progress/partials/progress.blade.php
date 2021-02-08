@php
switch ($offer->progress->progress) {
    case 30:
        $bar = 'bg-danger';
        break;
    case 50:
        $bar = 'bg-warning';
        break;
    case 70:
        $bar = 'bg-blue';
        break;
    case 85:
        $bar = 'bg-primary';
        break;
    case 90:
        $bar = 'bg-olive';
        break;
    case 99:
        $bar = 'bg-olive';
        break;

    default:
        $bar = 'bg-success';

        break;
}
@endphp

@switch($offer->approve)
    @case(1)
    <small>
        <div class="justify-content-center">
            <small class="text-secondary">On Progress</small>
        </div>
    </small>
    <div class="project_progress">
        <div class="progress progress-sm">
            <div class="progress-bar {{ $bar }}" role="progressbar"
                aria-volumenow="{{ $offer->progress->progress }}" aria-volumemin="0" aria-volumemax="100"
                style="width: {{ $offer->progress->progress }}%">
            </div>
        </div>
        <small>
            {{ $offer->progress->progress }}% Complete
        </small>
    </div>
    @break
    @case(2)
    <span class="text-danger">has been rejected.</span>

    @break
    @default
    <span class="text-primary">Ready to Approve.</span>
@endswitch
