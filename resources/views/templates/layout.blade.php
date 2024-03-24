<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=@y, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container my-3">
       <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="/">DJ Tutorial</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item {{ request()->is('/tutorials') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->is('/tutorials') ? 'active' : '' }}" href="/tutorials">Tutorials</a>
                    </li>
                    <li class="nav-item {{ request()->is('/review') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->is('/review') ? 'active' : '' }}" href="/review">Review</a>
                    </li>
                    <li class="nav-item {{ request()->is('/bookmarks') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->is('/bookmarks') ? 'active' : '' }}" href="/bookmarks">Bookmarks</a>
                    </li>
                </ul>
                
            </div>
            <ul class="navbar-nav d-flex justify-content-end">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.index') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf 
                            <button type="submit" class="btn nav-link btn-link">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registration.create') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bookmarks">Login</a>
                    </li>
                @endif
            </ul>
        </nav>
        @yield('main') 
    </div>
</body>
</html>