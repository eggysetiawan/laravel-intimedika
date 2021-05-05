  @hasrole('superadmin|it')
  {{-- PACS Installation --}}
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
  @endhasrole
