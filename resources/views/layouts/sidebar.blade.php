<aside class="main-sidebar sidebar-light-teal  elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link navbar-white text-sm">
        <img src="{{ asset('image/ipi2.png') }}" alt="Intimedika Puspa Indah"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('image/defaultpic.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @auth
                        {{ auth()->user()->name }}
                    @endauth
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- dashboard --}}
                <li class="nav-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link{{ request()->is('/') ? ' active' : '' }}">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Home</p>
                    </a>
                </li>

                {{-- advances --}}
                <li class="nav-header">Perjalanan Dinas</li>
                <li class="nav-item">
                    <a href="{{ route('advances.index') }}"
                        class="nav-link{{ request()->segment(1) == 'advances' ? ' active' : '' }}">
                        <i class="fas fa-luggage-cart nav-icon"></i>
                        <p>Perjalanan Dinas</p>
                    </a>
                </li>

                {{-- resource --}}
                <li class="nav-header">Resource</li>
                <li class="nav-item">
                    <a href="{{ route('modalities.index') }}"
                        class="nav-link {{ request()->segment(1) == 'modalities' ? ' active' : '' }}">
                        <i class="fas fa-charging-station nav-icon"></i>
                        <p>Alat Kesehatan</p>
                    </a>
                </li>

                {{-- customers --}}
                <li class="nav-item">
                    <a href="{{ route('customers.index') }}"
                        class="nav-link{{ request()->segment(1) == 'customers' ? ' active' : '' }}">
                        <i class="fas fa-street-view nav-icon"></i>
                        <p>Customer</p>
                    </a>
                </li>

                {{-- hospital --}}
                <li class="nav-item">
                    <a href="{{ route('hospitals.index') }}"
                        class="nav-link {{ request()->segment(1) == 'hospitals' ? ' active' : '' }}">
                        <i class="fas fa-hospital nav-icon"></i>
                        <p>Rumah Sakit</p>
                    </a>
                </li>

                {{-- IT --}}
                @include('layouts.sidebar._it')
                {{-- end IT --}}

                {{-- Sales --}}
                @include('layouts.sidebar._sales')
                {{-- end sales --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
