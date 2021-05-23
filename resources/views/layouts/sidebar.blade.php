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
                <img style="width: 35px; height: 35px;"
                    src="{{ asset(
    auth()->user()->getFirstMediaUrl('profile', 'thumb'),
) }}"
                    class="img-circle elevation-2" alt="{{ auth()->user()->initial }}">
            </div>
            <div class="info">
                <a href="{{ route('profiles.index') }}" class="d-block">
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
                {{-- Inventories --}}
                <li class="nav-item">
                    <a href="{{ route('inventories.index') }}"
                        class="nav-link{{ request()->segment(1) == 'inventories' ? ' active' : '' }}">
                        <i class="fas fa-archive nav-icon"></i>
                        <p>Inventory</p>
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
