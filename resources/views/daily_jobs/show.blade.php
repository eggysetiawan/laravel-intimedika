@extends('layouts.app', ['title'=> 'Laporan Harian',
'caption'=> $dailyJob->title ])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('daily_jobs.index') }}">Laporan Harian</a></li>
    <li class="breadcrumb-item">{{ Str::limit($dailyJob->slug, 30, '...') }}</li>
@endsection
@section('content')
    @unlessrole('director')
    @include('daily_jobs.partials._create-job')
    @endunlessrole
    @include('daily_jobs.partials._report')
@endsection
