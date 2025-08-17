<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('loading.png')}}" type="image/x-icon">

    <title>KnowTest</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .invalid-feedback {
        color: red;
    }


    nav {
        flex-shrink: 0; /* Prevent navbar from shrinking */
    }

    .navbar {
        background-color: #17021a;
    }

    .navbar-toggler {
        background-color: white;
    }

    .navbar-brand, .nav-link {
        color: white;
    }

    @media (max-width: 768px) {
        .navbar-collapse {
            background-color: orange; /* Background color for mobile menu */
        }

        .navbar-nav {
            flex-direction: column; /* Stack nav items vertically on small screens */
        }

        .navbar-nav .nav-item {
            text-align: center; /* Center align nav items on small screens */
        }
    }
</style>
<body>

        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white">
                    
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                          <!-- Authentication Links -->
                          <a href="/" class="btn btn-brand ms-lg-3" style="background-color: #2D0A32;border-color:white;color:white; margin-right:10px;">Home</a>
                                 
                    
                      </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="btn btn-brand ms-lg-3" style="background-color: #2D0A32;border-color:white;color:white; margin-right:10px;">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-brand ms-lg-3" style="background-color: #2D0A32;border-color:white;color:white">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

</body>
</html>
