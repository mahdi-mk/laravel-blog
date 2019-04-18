<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <!-- Code Sample -->
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet" />

    <!--Fontawesom-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!--fivicon-->
    <link rel="icon" type="image/png" href="{{ asset('blog.png') }}">
    
    <title>@yield('title') . Blog</title>

</head>
<body>
    <div class="pannel"></div>
    <nav class="navbar navbar-expand-lg navbar-light" style="box-shadow:transparent; margin-bottom:0px;">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('blog.png') }}" width="30" height="30" class="d-inline-block align-top" alt="blog">
        </a>
        <button class="burger-menu navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto order-1">
                <li class="nav-item">
                    <a href="/" class="nav-link navbar-link link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/explore" class="nav-link navbar-link link">Explore</a>
                </li>
                <li class="nav-item">
                    <a href="/categories" class="nav-link navbar-link link">Categories</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto order-2">
                    <form action="{{ route('search') }}">
                            @csrf
                            <div class="input-group">
                            <input name="search" id="search" type="text" class="form-control bg-light border-0 small" style="width:300px;" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn" style="background:#47c9e5; border:#fff" type="button">
                                <i style="color:#fff;" class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                            </div>
                        </form>
        
                    </ul>
            <ul class="navbar-nav d-none d-lg-flex ml-2 order-3">
                @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link login-btn">Log in</a>
                </li>

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link register-btn">Register</a>
                    </li>
                @endif
                @endguest

                @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle navbar-link link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position:relative; padding-left:50px;">
                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name}}" style="width:32px; height:32px; position:absolute; top:5px; left:10px; border-radius:50%;">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right nav-dropdown animated--grow-in" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile.edit', ['user' => Auth::user()->id,'slug' => Auth::user()->slug]) }}">Edit your profile</a>
                        <a class="dropdown-item" href="">Your articles</a>
                        <a class="dropdown-item" href="">Create article</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="">Settings</a>
                        <a class="dropdown-item" href="">Help</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item nav-dropdown" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div>
        @yield('profile-details')
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">@yield('articles')</div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>