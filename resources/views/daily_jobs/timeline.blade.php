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
    <div class="col-md-12">
        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <x-button-create href="{{ route('daily_jobs.create') }}">Buat Laporan</x-button-create>
            </div>
        </div>
    </div>
    @endunlessrole
    @forelse ($dailyJobs as $dailyJob)

        <div class="d-flex justify-content-center mt-2">
            <div class="col-md-6">
                <!-- Box Comment -->
                <div class="card card-widget">
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Image">
                            <span class="username"><a href="#">{{ $dailyJob->author->name }}.</a></span>
                            <span class="description">Di publikasikan pada - {{ $dailyJob->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <!-- /.user-block -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" title="Mark as read">
                                <i class="far fa-circle"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- post text -->
                        <h4 class="attachment-heading">{{ $dailyJob->title }}</h4>
                        <p>{{ $dailyJob->description }}</p>

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
    @empty
        <span>Belum ada data.</span>
    @endforelse

    <div class="row justify-content-center">
        {{ $dailyJobs->links() }}
    </div>

@endsection
