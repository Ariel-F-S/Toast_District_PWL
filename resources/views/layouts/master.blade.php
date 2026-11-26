<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Toast.district')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --cream: #F8F3EA;
            --brown: #8B5E3C;
            --dark-brown: #38271F;
            --orange: #E99B50;
            --light-brown: #EADBC8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--cream);
            color: var(--dark-brown);
        }

        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
        }

        a {
            text-decoration: none;
        }

        /* NAVBAR */
        .navbar {
            background-color: var(--cream);
            padding: 18px 0;
            border-bottom: 1px solid rgba(139, 94, 60, 0.12);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            font-weight: 700;
            color: var(--dark-brown);
        }

        .navbar-brand span {
            color: var(--brown);
        }

        .navbar .nav-link {
            color: var(--dark-brown);
            font-size: 14px;
            font-weight: 500;
            margin: 0 12px;
            transition: 0.3s;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--brown);
            font-weight: 600;
        }

        .btn-toast {
            background-color: var(--brown);
            color: white;
            border: 1px solid var(--brown);
            border-radius: 30px;
            padding: 9px 22px;
            font-size: 13px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-toast:hover {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
            color: white;
        }

        .btn-toast-outline {
            background-color: transparent;
            color: var(--dark-brown);
            border: 1px solid var(--brown);
            border-radius: 30px;
            padding: 9px 22px;
            font-size: 13px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-toast-outline:hover {
            background-color: var(--light-brown);
            color: var(--dark-brown);
        }

        /* FOOTER */
        .footer {
            background-color: var(--dark-brown);
            color: var(--cream);
            padding: 45px 0 20px;
        }

        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            font-weight: 700;
        }

        .footer p {
            font-size: 13px;
            color: #D8C8B8;
            line-height: 1.8;
        }

        .footer a {
            color: #D8C8B8;
            font-size: 13px;
        }

        .footer a:hover {
            color: var(--orange);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar .nav-link {
                margin: 5px 0;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('menu') ? 'active' : '' }}" href="{{ url('/menu') }}">Our Menu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('sponsorship') ? 'active' : '' }}" href="{{ url('/sponsorship') }}">Sponsorship</a>
                    </li>
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
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'Akun' }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm" style="background-color: #fffdf9; border-radius: 14px;">
                                <li>
                                    <a class="dropdown-item py-2" href="{{ url('/dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
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

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">

            <div class="row gy-4">

                <div class="col-md-5">
                    <div class="footer-brand">
                        toast.district
                    </div>

                    <p class="mt-3">
                        A little toast, a lot of happiness.
                        Bringing delicious moments to your everyday life.
                    </p>
                </div>

                <div class="col-md-3">
                    <h6 class="mb-3">Explore</h6>
                    <p><a href="{{ url('/') }}">Home</a></p>
                    <p><a href="{{ url('/menu') }}">Our Menu</a></p>
                    <p><a href="{{ url('/sponsorship') }}">Sponsorship</a></p>
                </div>

                <div class="col-md-4">
                    <h6 class="mb-3">Find Us</h6>
                    <p>Toast.district</p>
                    <p>Delicious toast, made with love.</p>
                </div>

            </div>

            <hr style="border-color: #806A58;">

            <div class="text-center">
                <p class="mb-0">
                    &copy; {{ date('Y') }} Toast.district.
                    All Rights Reserved.
                </p>
            </div>

        </div>
    </footer>

    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>