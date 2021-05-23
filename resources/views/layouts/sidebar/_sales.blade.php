  @hasrole('director|sales|superadmin')
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

  {{-- kunjungan/visits --}}
  <li class="nav-header">Kunjungan Harian</li>
  <li class="nav-item">
      <a href="{{ route('visitplan.index') }}"
          class="nav-link{{ request()->segment(1) == 'visitplan' ? ' active' : '' }}">
          <i class="fas fa-map-marked-alt nav-icon"></i>
          <p>Rencana Kunjungan</p>
      </a>
  </li>

  {{-- visits --}}
  <li class="nav-item">
      <a href="{{ route('visits.index') }}"
          class="nav-link{{ request()->segment(1) == 'visits' ? ' active' : '' }}">
          <i class="fas fa-route nav-icon"></i>
          <p>Kunjungan</p>
      </a>
  </li>

  {{-- funnels --}}
  <li class="nav-header">Funnel</li>
  <li class="nav-item">
      <a href="{{ route('funnels.index') }}" class="nav-link{{ request()->is('funnels') ? ' active' : '' }}">
          <i class="fas fa-funnel-dollar nav-icon"></i>
          <p>Sales Funnel</p>
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
  @endhasrole


  {{-- approval penawaran & purchase --}}
  @hasrole('director|superadmin')
  <li class="nav-item">
      <a href="{{ route('offers.approval') }}"
          class="nav-link {{ request()->segment(1) == 'offers' && request()->segment(2) == 'approval' ? ' active' : '' }}">
          <i class="fas fa-exclamation nav-icon"></i>
          <p>Approve Penawaran </p>
          @if ($readyToApprove > 0)
              <span class="badge badge-danger right">{{ $readyToApprove }}</span>
          @endif
      </a>
  </li>
  <li class="nav-item">
      <a href="{{ route('progresses.approval') }}"
          class="nav-link {{ request()->segment(1) == 'progresses' && request()->segment(2) == 'approval' ? ' active' : '' }}">
          <i class="fas fa-hand-holding-usd nav-icon"></i>
          <p>Approve Purchase-Order</p>
          @if ($readyToPurchase > 0)
              <span class="badge badge-danger right">{{ $readyToPurchase }}</span>
          @endif

      </a>
  </li>

  {{-- penawaran berhasil --}}
  <li class="nav-item">
      <a href="{{ route('offers.complete') }}"
          class="nav-link {{ request()->segment(1) == 'offers' && request()->segment(2) == 'complete' ? ' active' : '' }}">
          <i class="fas fa-check-circle nav-icon"></i>
          <p>Penawaran Berhasil</p>
      </a>
  </li>
  @endhasrole
