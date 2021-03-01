@php
use App\Offer;
@endphp
<aside class="main-sidebar sidebar-dark-teal elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link navbar-teal text-sm">
        <img src="{{ asset('image/ipi2.png') }}" alt="Intimedika Puspa Indah"
            class="brand-image img-circle elevation-3" style="opacity: .8">
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
                        {{ auth()->user()->name }}
                    @endauth
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link{{ request()->is('/') ? ' active' : '' }}">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Home</p>
                    </a>
                </li>

                {{-- kunjungan/visits --}}
                <li class="nav-header">Kunjungan Harian</li>
                <li class="nav-item">
                    <a href="{{ route('visitplan.index') }}"
                        class="nav-link{{ request()->segment(1) == 'visitplan'  ? ' active' : '' }}">
                        <i class="fas fa-map-marked-alt nav-icon"></i>
                        <p>Rencana Kunjungan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('visits.index') }}"
                        class="nav-link{{ request()->segment(1) == 'visits' && !request()->segment(2) ? ' active' : '' }}">
                        <i class="fas fa-route nav-icon"></i>
                        <p>Kunjungan</p>
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

                <li class="nav-item">
                    <a href="{{ route('customers.index') }}"
                        class="nav-link{{ request()->segment(1) == 'customers' ? ' active' : '' }}">
                        <i class="fas fa-street-view nav-icon"></i>
                        <p>Customer</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('hospitals.index') }}"
                        class="nav-link {{ request()->segment(1) == 'hospitals' ? ' active' : '' }}">
                        <i class="fas fa-hospital nav-icon"></i>
                        <p>Rumah Sakit</p>
                    </a>
                </li>

                {{-- penawaran --}}
                <li class="nav-header">Penawaran</li>
                <li class="nav-item">
                    <a href="{{ route('offers.index') }}"
                        class="nav-link {{ (request()->segment(1) == 'offers' && !request()->segment(2)) || request()->segment(2) == 'filter' ? ' active' : '' }}">
                        <i class="fab fa-buffer nav-icon"></i>
                        <p>Semua Penawaran</p>
                    </a>
                </li>
                @can('approval')
                    <li class="nav-item">
                        <a href="{{ route('offers.approval') }}"
                            class="nav-link {{ request()->segment(1) == 'offers' && request()->segment(2) == 'approval' ? ' active' : '' }}">
                            <i class="fas fa-exclamation nav-icon"></i>
                            <p>Approve Penawaran @if (Offer::whereNull('is_approved')->count() > 0)
                                    <span
                                        class="badge badge-danger right">{{ Offer::whereNull('is_approved')->count() }}</span>
                                @endif
                            </p>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('progresses.approval') }}"
                            class="nav-link {{ request()->segment(1) == 'progresses' && request()->segment(2) == 'approval' ? ' active' : '' }}">
                            <i class="fas fa-exclamation nav-icon"></i>
                            <p>Approve Purchase-Order</p>
                            @if (Offer::with('progressApproval')
            ->whereHas('progressApproval')
            ->count() > 0)
                                <span
                                    class="badge badge-danger ">{{ Offer::with('progressApproval')->whereHas('progressApproval')->count() }}</span>
                            @endif

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('offers.complete') }}"
                            class="nav-link {{ request()->segment(1) == 'offers' && request()->segment(2) == 'complete' ? ' active' : '' }}">
                            <i class="far fa-check-circle nav-icon"></i>
                            <p>Penawaran Berhasil</p>
                        </a>
                    </li>
                @endcan



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
