<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            toast<span>.district</span>
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarToast">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToast">

            <ul class="navbar-nav mx-auto">
                @auth
                    @if (Auth::user()->role === 'owner')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('owner/users*') ? 'active' : '' }}" href="{{ route('owner.users.index') }}">Kelola User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('owner/menus*') ? 'active' : '' }}" href="{{ url('/owner/menus') }}">Kelola Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pesanan*') ? 'active' : '' }}" href="{{ url('/pesanan') }}">Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('owner/laporan*') ? 'active' : '' }}" href="{{ url('/owner/laporan') }}">Laporan</a>
                        </li>

                    @elseif (Auth::user()->role === 'kasir')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('kasir*') ? 'active' : '' }}" href="{{ url('/kasir') }}">Kasir POS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pesanan*') ? 'active' : '' }}" href="{{ url('/pesanan') }}">Pesanan Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('menu*') ? 'active' : '' }}" href="{{ url('/menu') }}">Lihat Katalog</a>
                        </li>

                    @else
                        <!-- Role Pelanggan -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('menu*') ? 'active' : '' }}" href="{{ url('/menu') }}">Our Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('sponsorship*') ? 'active' : '' }}" href="{{ url('/sponsorship') }}">Sponsorship</a>
                        </li>
                    @endif
                @else
                    <!-- Guest (Belum Login) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('menu*') ? 'active' : '' }}" href="{{ url('/menu') }}">Our Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('sponsorship*') ? 'active' : '' }}" href="{{ url('/sponsorship') }}">Sponsorship</a>
                    </li>
                @endauth
            </ul>

            <!-- AUTH BUTTONS -->
            <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                @guest
                    <a href="{{ url('/login') }}" class="btn btn-toast-outline">
                        Login
                    </a>
                    <a href="{{ url('/register') }}" class="btn btn-toast">
                        Register
                    </a>
                @endguest

                @auth
                    <div class="dropdown">
                        <button class="btn btn-toast dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->nama ?? 'Akun' }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm" style="background-color: #fffdf9; border-radius: 14px; min-width: 210px;">
                            <li class="px-3 py-2">
                                <small class="text-muted d-block" style="font-size: 11px;">Login sebagai</small>
                                <span class="badge rounded-pill text-uppercase" style="background-color: #F3EAE0; color: var(--brown); font-size: 10px;">
                                    {{ Auth::user()->role }}
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ url('/logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</nav>