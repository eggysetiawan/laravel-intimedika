@extends('layouts.app', ['title'=> $visit->request])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('visits.index') }}">Kunjungan Harian</a></li>
    <li class="breadcrumb-item">{{ Str::limit($visit->request, 15) }}</li>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <!-- Box Comment -->
            <div class="card card-widget">

                <!-- /.card-header -->
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="{{ $visit->customer->gravatar() }}" alt="User Image">
                        <span class="username"><a href="#">{{ $visit->customer->hospitals->first()->name }}</a></span>
                        <span class="description">{{ $visit->customer->hospitals->first()->name }} -
                            {{ $visit->created_at->diffForHumans() }}</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="card-tools">
                        <button title="Minimize" type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                        @can('update', $visit)
                            <a href="{{ route('customers.edit', $visit->customer->slug) }}" title="Edit ">
                                <button class="btn btn-tool"><i class="fas fa-user-edit"></i></button>
                            </a>
                        @endcan

                        @can('delete', $visit)
                            <button type="button" title="Hapus" data-toggle="modal" data-target="#exampleModal"
                                class="btn btn-tool"><i class="fas fa-times"></i>
                            </button>
                        @endcan
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body">
                    @if ($visit->getFirstMedia('images'))
                        <img class="img-fluid pad" style="height:270px;object-fit:cover;object-position:center;width:600px"
                            src="{{ asset($visit->getFirstMedia('images')->getUrl()) }}" alt="Photo">
                    @endif

                    <p>
                        <dt>Permintaan</dt>
                        <dd>{{ $visit->request }}</dd>
                    </p>
                    <hr>
                    <p>
                        <dt>Hasil Kunjungan</dt>
                        <dd>{{ $visit->result }}</dd>
                    </p>
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                    <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                    <span class="float-right text-muted">{{ $visit->comments->count() }} comments</span>
                </div>
                <!-- /.card-body -->
                @if ($visit->comments->count() > 0)
                    <div class="card-footer card-comments">
                        @foreach ($visit->comments as $comment)
                            <div class="card-comment">
                                <!-- User image -->
                                <img class="img-circle img-sm" src="{{ $comment->author->gravatar() }}" alt="User Image">

                                <div class="comment-text">
                                    <span class="username">
                                        {{ $comment->author->name }}
                                        <span
                                            class="text-muted float-right">{{ $comment->created_at->diffForHumans() }}</span>
                                    </span><!-- /.username -->
                                    {{ $comment->comment }}
                                </div>
                                <!-- /.comment-text -->
                            </div>
                        @endforeach

                    </div>
                @endif



                <!-- /.card-footer -->
                <div class="card-footer">
                    <form action="#" method="post">
                        <img class="img-fluid img-circle img-sm" src="{{ auth()->user()->gravatar() }}" alt="Alt Text">
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class="img-push">
                            <input type="text" class="form-control form-control-sm"
                                placeholder="Press enter to post comment">
                        </div>
                    </form>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('visits.delete', $visit->slug) }}" method="POST">
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
