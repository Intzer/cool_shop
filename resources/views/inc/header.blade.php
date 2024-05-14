<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('header.title', config('app.name'))</title>

    {{-- Bootstrap --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>
<body>
    <header>
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                <a href="{{ route('products.index') }}" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none h4">
                    {{ config('app.name') }}
                </a>

                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('categories.index') }}" class="nav-link px-2 link-dark">{{ __('Categories') }}</a></li>
                </ul>

                <div class="col-md-4 text-end">
                    @auth()
                        {{ __('Hello') }}, <b>{{ auth()->user()->firstname }}</b>
                        @if (auth()->user()->admin)
                            <a href="{{ route('admin.index') }}" class="btn btn-primary ms-3">{{ __('Admin Panel') }} <i class="fa-solid fa-star"></i></a>
                        @endif
                        <a href="{{ route('login.logout') }}" class="btn btn-primary ms-2">{{ __('Logout') }} <i class="fa-solid fa-right-from-bracket"></i></a>
                    @endauth

                    @guest()
                        <a href="{{ route('login.index') }}" class="btn btn-outline-primary me-2">{{ __('Login') }} <i class="fa-solid fa-right-to-bracket"></i></a>
                        <a href="{{ route('register.index') }}" class="btn btn-primary">{{ __('Register') }} <i class="fa-solid fa-plus"></i></a>
                    @endguest
                </div>
            </header>
        </div>
    </header>

    @if(session('message'))
        <div class="container">
            <div class="alert alert-info" role="alert">
                {{ session()->pull('message') }}
            </div>
        </div>
    @endif
