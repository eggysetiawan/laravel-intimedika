@php
$progress = $funnel->progress;
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


<div class="project_progress">
    <div class="progress progress-sm">
        <div class="progress-bar {{ $bar }} progress-bar-striped" role="progressbar"
            aria-volumenow="{{ $progress }}" aria-volumemin="0" aria-volumemax="100"
            style="width: {{ $progress }}%">
        </div>
    </div>
    <small>
        {{ $progress }}%
    </small>
</div>
