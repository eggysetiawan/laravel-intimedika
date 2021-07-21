@extends('layouts.app',[
'title' => 'Pacs Report',
])

@section('breadcrumb')
<li class="breadcrumb-item active">Export Laporan</li>
@endsection
@section('content')
    <livewire:pacs.export />
@endsection
