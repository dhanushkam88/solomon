<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('custom_meta')
    <title>My Tracker - @yield('title')</title>
    <!-- Custom CSS -->
    @yield('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <!-- Navbar Start-->
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand text-uppercase" href="#">My <span class="text-primary">Tracker</span></a>
                <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-uppercase" id="offcanvasDarkNavbarLabel">My <span class="text-primary">Tracker</span></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('createTrackingPage') }}">New Tickets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('trackingPage') }}">Find My Tickets</a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    @auth
                                        <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                                    @else
                                        <a class="nav-link" href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                                </li>
                                <li class="nav-item">
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                                        @endif
                                    @endauth
                                </li>
                            @role('vendor|admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                                </li>
                            @endrole
                            @auth
                                <li class="nav-item">
                                    <form method="POST" action="{{ route('logout') }}" id="form-id">
                                        @csrf
                                        <a class="nav-link" type="submit" href="#" onclick="document.getElementById('form-id').submit();">{{ __('Log Out') }} </a>
                                    </form>
                                </li>
                            @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar end-->
    </div>
    @yield('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('custom_js')
</body>
</html>
