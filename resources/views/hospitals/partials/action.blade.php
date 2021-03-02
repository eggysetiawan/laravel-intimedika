<!-- Disini Define View untuk action -->

<a href="{{ route('hospitals.edit', ['hospital' => $hospital->slug]) }}" class="btn btn-warning">Edit</a>
<a href="{{ route('hospitals.destroy', ['hospital' => $hospital->slug]) }}" class="btn btn-danger">Delete</a>
