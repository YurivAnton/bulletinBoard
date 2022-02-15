<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="/css/app.css" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="container">
    <header>
        @if (Route::has('login'))
            <div class="container">
                <div class="row">
                    <ul class="nav nav-pills pull-right">
                        @if (Auth::check())
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="/admin">Admin</a></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        @endif
    </header>
    <div class="clearfix"></div>

    @yield('nav')

    <div id="main">
        <div class="row">
            <div class="col-md-4">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @yield('main')
            </div>
        </div>
    </div>
    <div id="method">
        <div class="row">
            <div class="col-md-4">
                @yield('method')
            </div>
        </div>
    </div>

</div>
<footer></footer>

<script src="/js/app.js"></script>
</body>
</html>
