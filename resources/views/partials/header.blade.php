<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-flat float-end">
                        <i class="bi bi-box-arrow-right"></i> {{ __('message.sign_out') }}
                    </button>
                </form>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="user-image rounded-circle shadow"
                        alt="User Image">
                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
