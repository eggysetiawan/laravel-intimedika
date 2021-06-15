@extends('layouts.app', ['title'=> 'Intiwid Support',
'caption'=> 'hospital' ])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pacs_supports.index') }}">Intiwid Support</a></li>
    <li class="breadcrumb-item">{{ $pacsSupport->slug }}</li>
@endsection
@section('content')
    @unlessrole('director')
    @include('pacs.supports.partials._create-support')
    @endunlessrole
    <div class="d-flex justify-content-center mt-2">
        <div class="col-md-6">
            <!-- Box Comment -->
            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="{{ asset('image/defaultpic.jpg') }}" alt="User Image">
                        <span class="username"><a href="#">{{ $pacsSupport->installation->hospital->name }}.</a></span>
                        <span class="description">Di publikasikan pada - {{ $pacsSupport->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <!-- /.user-block -->
                    <form action="{{ route('pacs_supports.destroy', $pacsSupport->slug) }}"
                        class="form-inline justify-content-end px-0 mx-0" method="POST">
                        @csrf
                        @method('delete')
                        <div class="card-tools">
                            <a href="{{ route('pacs_supports.edit', $pacsSupport->slug) }}" type="button"
                                class="btn btn-tool" title="Edit Post">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                            <button type="submit" class="btn btn-tool" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </form>

                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- post text -->
                    <h4 class="attachment-heading">Permasalahan</h4>
                    <p>{{ $pacsSupport->problem }}</p>
                    <div class="mb-4">
                        <h4 class="attachment-heading">Dilaporkan oleh</h4>
                        <small class="py-0">pada -
                            {{ $pacsSupport->report_time->format('H:i') . ', ' . $pacsSupport->report_date->format('d F, Y') }}</small>
                    </div>
                    <p>{{ $pacsSupport->hospital_personel }}</p>
                    <hr>
                    <div class="mb-4">
                        <h4 class="attachment-heading">Penyelesaian</h4>
                        <small class="py-0">pada -
                            {{ $pacsSupport->solve_time->format('H:i') . ', ' . $pacsSupport->solve_date->format('d F, Y') }}</small>
                    </div>
                    <p>{{ $pacsSupport->solve }}</p>
                    <hr>
                    <h4 class="attachment-heading">Nama Teknisi</h4>
                    <p>{{ $engineers }}</p>

                    <!-- Attachment -->
                    {{-- <div class="attachment-block clearfix">
                            <img class="attachment-img" src="../dist/img/photo1.png" alt="Attachment Image">
                            <div class="attachment-pushed">
                                <h4 class="attachment-heading"><a href="https://www.lipsum.com/">Lorem ipsum text
                                        generator</a>
                                </h4>
                                <div class="attachment-text">
                                    Description about the attachment can be placed here.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry... <a
                                        href="#">more</a>
                                </div>
                                <!-- /.attachment-text -->
                            </div>
                            <!-- /.attachment-pushed -->
                        </div> --}}
                    <!-- /.attachment-block -->

                    <!-- Social sharing buttons -->
                    {{-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                        <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                        <span class="float-right text-muted">45 likes - 2 comments</span> --}}
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer card-comments">
                        <div class="card-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="User Image">
                            <div class="comment-text">
                                <span class="username">
                                    Maria Gonzales
                                    <span class="text-muted float-right">8:03 PM Today</span>
                                </span><!-- /.username -->
                                It is a long established fact that a reader will be distracted
                                by the readable content of a page when looking at its layout.
                            </div>
                            <!-- /.comment-text -->
                        </div>
                        <!-- /.card-comment -->
                        <div class="card-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm" src="../dist/img/user5-128x128.jpg" alt="User Image">
                            <div class="comment-text">
                                <span class="username">
                                    Nora Havisham
                                    <span class="text-muted float-right">8:03 PM Today</span>
                                </span><!-- /.username -->
                                The point of using Lorem Ipsum is that it hrs a morer-less
                                normal distribution of letters, as opposed to using
                                'Content here, content here', making it look like readable English.
                            </div>
                            <!-- /.comment-text -->
                        </div>
                        <!-- /.card-comment -->
                    </div> --}}
                <!-- /.card-footer -->
                {{-- <div class="card-footer">
                        <form action="#" method="post">
                            <img class="img-fluid img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="Alt Text">
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <div class="img-push">
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Press enter to post comment">
                            </div>
                        </form>
                    </div> --}}
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
