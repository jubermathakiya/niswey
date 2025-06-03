<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>{{ __('message.menu.dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}" class="nav-link {{ Route::is('contacts.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>{{ __('message.menu.contact') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
