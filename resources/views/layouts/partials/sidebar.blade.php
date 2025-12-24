<nav class="sidebar sidebar-offcanvas sidebar-dark" id="sidebar">
    <ul class="nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- Customer - untuk Marketing dan Manager -->
        @if(isset($menuAccess['customer']) && in_array($departemen, $menuAccess['customer']))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('customer.*') ? 'active' : '' }}" href="{{ route('customer.index') }}">
                <i class="menu-icon mdi mdi-account-search"></i>
                <span class="menu-title">Customer</span>
            </a>
        </li>
        @endif

        <!-- Part - untuk Marketing dan Manager -->
        @if(isset($menuAccess['part']) && in_array($departemen, $menuAccess['part']))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('part.*') ? 'active' : '' }}" href="{{ route('part.index') }}">
                <i class="menu-icon mdi mdi-cube-outline"></i>
                <span class="menu-title">Part</span>
            </a>
        </li>
        @endif

        <!-- Petugas - hanya untuk Manager -->
        @if(isset($menuAccess['petugas']) && in_array($departemen, $menuAccess['petugas']))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <i class="menu-icon mdi mdi-account-check"></i>
                <span class="menu-title">Petugas</span>
            </a>
        </li>
        @endif

        <!-- Kendaraan - untuk PPIC dan Manager -->
        @if(isset($menuAccess['kendaraan']) && in_array($departemen, $menuAccess['kendaraan']))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}" href="{{ route('kendaraan.index') }}">
                <i class="menu-icon mdi mdi-car"></i>
                <span class="menu-title">Kendaraan</span>
            </a>
        </li>
        @endif

        <!-- Purchase Order - untuk Marketing, PPIC, Finance, Manager -->
        @if(isset($menuAccess['po']) && in_array($departemen, $menuAccess['po']))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('po.*') ? 'active' : '' }}" href="{{ route('po.index') }}">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Purchase Order</span>
            </a>
        </li>
        @endif

        <!-- Surat Jalan - untuk PPIC, Finance, Manager -->
        @if(isset($menuAccess['suratjalan']) && in_array($departemen, $menuAccess['suratjalan']))
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('suratjalan.*') ? 'active' : '' }}" href="{{ route('suratjalan.index') }}">
                <i class="menu-icon mdi mdi-file-find"></i>
                <span class="menu-title">Surat Jalan</span>
            </a>
        </li>
        @endif
        
    </ul>
</nav>