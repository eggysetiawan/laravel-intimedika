@extends('layouts.app', ['title'=> 'Laporan Harian',
'caption'=> 'Laporan Harian'])

@section('breadcrumb')
    <li class="breadcrumb-item">Laporan Harian</li>
    {{-- <li class="breadcrumb-item">Slug/Name Here</li> --}}
@endsection
@section('content')

    <div class="col-md-12 mb-2">
        <div class="d-flex justify-content-end">
            <div class="btn-group btn-group-sm">
                <a href="{{ route('daily_jobs.index') }}" class="btn btn-secondary">
                    <i class="fas fa-table nav-icon"></i> Table
                </a>
                <a href="{{ route('daily_jobs.timeline') }}" class="btn bg-teal">
                    <i class="fas fa-align-justify nav-icon"></i> Timeline
                </a>
            </div>
        </div>
    </div>
    @unlessrole('director')
    @include('daily_jobs.partials._create-job')
    @endunlessrole

    @forelse ($dailyJobs as $dailyJob)
        @include('daily_jobs.partials._report')
    @empty
        <span>Belum ada data.</span>
    @endforelse

    <div class="row justify-content-center">
        {{ $dailyJobs->links() }}
    </div>
@endsection
