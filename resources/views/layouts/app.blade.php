<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'IPI Portal | ' . $title ?? 'Portal Intimedika' }}</title>

    <!-- Ionicons -->
    @include('layouts.head')

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse accent-teal">
    {{-- Preloader Content --}}
    @include('layouts.preloader')


    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Containers -->
        @include('layouts.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ $caption ?? '' }}</h1>
                        </div>
                        @include('layouts.breadcrumb')
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div> <!-- /.content-header -->

            <!-- Main content -->
            <main class="content">
                <div class="container">
                    @yield('content')
                </div>
            </main>
            <!-- /.content -->

        </div><!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('layouts.control-sidebar')
        <!-- /.control-sidebar -->
        <a id="button-back" href="#" class="btn bg-teal back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
        <!-- Main Footer -->
        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('layouts.script-footer')
    @yield('script')
</body>


</html>
