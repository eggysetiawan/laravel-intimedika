@extends('layouts.app', ['title'=> $visit->request])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/visits">Kunjungan Harian</a></li>
    <li class="breadcrumb-item">{{ Str::limit($visit->request, 15) }}</li>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-11">
            <h1><a href="{{ route('customers.show', $visit->customer->slug) }}">{{ $visit->customer->name }}</a></h1>
            <a href="{{ route('customers.edit', $visit->customer->slug) }}">Edit data customer</a>
            <hr>
            <small class="text-secondary">
                Diterbitkan pada : {{ $visit->created_at->format('d F, Y') }} - {{ $visit->customer->hospital->name }}
            </small>
            <div>
                {{ $visit->result }}
            </div>
            <!-- Button trigger modal -->
            <a href="javascript:" class="text-danger px-2" data-toggle="modal" data-target="#exampleModal">
                Delete
            </a>
            <a href="{{ route('visits.edit', $visit->slug) }}">Edit</a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="/visits/{{ $visit->slug }}/delete" method="POST">
                        @csrf
                        @method('delete')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">anda yakin ingin menghapus?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>{{ Str::limit($visit->result, 50) }}</div>
                                <small class="text-secondary">
                                    Published on : {{ $visit->created_at->format('d F, Y') }}
                                </small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
