@extends('layouts.app')
@section('title', 'Post')

@section('breadcrumb')
<li class="breadcrumb-item">Dashboard</li>
@endsection
@section('content')
<div class="container">
    <p>
        <h1>{{ $slug }}</h1>
    </p>
</div>
@endsection
