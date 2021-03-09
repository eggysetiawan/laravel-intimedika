@php
$progress = $funnel->progress;
switch ($progress) {
    case 10:
        $bar = 'bg-danger';
        break;
    case 20:
        $bar = 'bg-danger';
        break;
    case 30:
        $bar = 'bg-orange';
        break;
    case 40:
        $bar = 'bg-orange';
        break;
    case 50:
        $bar = 'bg-orange';
        break;
    case 60:
        $bar = 'bg-warning';
        break;
    case 70:
        $bar = 'bg-warning';
        break;
    case 80:
        $bar = 'bg-primary';
        break;
    case 90:
        $bar = 'bg-primary';
        break;

    default:
        $bar = 'bg-success';

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
