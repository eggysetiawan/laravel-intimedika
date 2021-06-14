  @hasrole('superadmin|it')
  {{-- advances --}}
  {{-- <li class="nav-header">Perjalanan Dinas</li>
  <li class="nav-item">
      <a href="{{ route('advances.index') }}"
          class="nav-link{{ request()->segment(1) == 'advances' ? ' active' : '' }}">
          <i class="fas fa-luggage-cart nav-icon"></i>
          <p>Perjalanan Dinas</p>
      </a>
  </li> --}}
  @endhasrole


  @role('superadmin')
  {{-- management users --}}
  <li class="nav-header">Management User</li>
  <li class="nav-item">
      <a href="{{ route('managements.index') }}"
          class="nav-link{{ request()->segment(1) == 'managements' ? ' active' : '' }}">
          <i class="fas fa-users-cog nav-icon"></i>
          <p>Management User</p>
      </a>
  </li>
  @endrole

  @hasrole('superadmin|it')
  {{-- PACS Installation --}}
  <li class="nav-header">Laporan Harian</li>
  <li class="nav-item">
      <a href="{{ route('daily_jobs.index') }}"
          class="nav-link{{ request()->segment(1) == 'daily_jobs' ? ' active' : '' }}">
          <i class="fas fa-calendar-alt nav-icon"></i>
          <p>Laporan Harian</p>
      </a>
  </li>
  <li class="nav-header">Instalasi PACS</li>
  <li class="nav-item">
      <a href="{{ route('pacs_installations.index') }}"
          class="nav-link{{ request()->segment(1) == 'pacs_installations' ? ' active' : '' }}">
          <i class="fas fa-download nav-icon"></i>
          <p>Instalasi PACS</p>
      </a>
  </li>
  <li class="nav-item">
      <a href="{{ route('pacs_supports.index') }}"
          class="nav-link{{ request()->segment(1) == 'pacs_supports' ? ' active' : '' }}">
          <i class="fas fa-phone-alt nav-icon"></i>
          <p>Support PACS</p>
      </a>
  </li>
  @hasrole('supervisor|superadmin')
  <li class="nav-item">
      <a href="{{ route('pacs_exports') }}"
          class="nav-link{{ request()->segment(1) == 'pacs_exports' ? ' active' : '' }}">
          <i class="fas fa-file-export nav-icon"></i>
          <p>PACS Report</p>
      </a>
  </li>
  @endhasrole

  @endhasrole
