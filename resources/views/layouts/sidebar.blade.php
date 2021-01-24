<aside class="main-sidebar  sidebar-dark-teal elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link navbar-teal text-sm">
        <img src="{{ asset('image/ipi2.png') }}" alt="Intimedika Puspa Indah" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @auth
                        {{ Auth::user()->name }}
                    @endauth
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-{{ request()->is('/') ? 'open' : 'close' }}">
                    <a href="{{ route('home') }}" class="nav-link{{ request()->is('/') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link{{ request()->is('/') ? ' active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Home</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item has-treeview menu-open">
                    <a href="#!" class="nav-link{{ request()->is('artikel') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>
                            Resource
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link {{ 'kunjungan' == request()->path() ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li> --}}
                        {{-- </ul>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('modalities.index') }}"
                        class="nav-link {{ request()->segment(1) == 'modalities' ? ' active' : '' }}">
                        <i class="fas fa-charging-station nav-icon"></i>
                        <p>Alat Kesehatan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customers.index') }}"
                        class="nav-link{{ request()->segment(1) == 'customers' ? ' active' : '' }}">
                        <i class="fas fa-street-view nav-icon"></i>
                        <p>Customer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('visits.index') }}"
                        class="nav-link{{ request()->segment(1) == 'visits' ? ' active' : '' }}">
                        <i class="fas fa-route nav-icon"></i>
                        <p>Kunjungan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('offers.index') }}"
                        class="nav-link {{ request()->segment(1) == 'offers' ? ' active' : '' }}">
                        <i class="fab fa-buffer nav-icon"></i>
                        <p>Penawaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('hospitals.index') }}"
                        class="nav-link {{ request()->segment(1) == 'hospitals' ? ' active' : '' }}">
                        <i class="fas fa-hospital nav-icon"></i>
                        <p>Rumah Sakit</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="/kunjungan" class="nav-link {{ 'kunjungan' == request()->path() ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Kunjungan Harian
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
