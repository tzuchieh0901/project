<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>104線上學校</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    104線上學校
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/courses') }}">
                                <span data-feather="book-open"></span> 所有課程
                            </a>
                        </li>
                        @can('user')
                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ url('/carts') }}">
                                    <span data-feather="shopping-cart"></span> 購物車
                                </a>
                            </li>
                        @endcan
                        @can('admin')
                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ url('/carts') }}">
                                    <span data-feather="shopping-cart"></span> 購物車
                                </a>
                            </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <button class="btn btn-outline-primary">
                                        {{ __('登入') }}
                                    </button>
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <button class="btn btn-primary">
                                            {{ __('註冊') }}
                                        </button>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @can('admin')
                                    <a class="dropdown-item" href="{{ url('/admin') }}">
                                        後台管理
                                    </a>
                                    @endcan

                                    @can('teacher')
                                    <a class="dropdown-item" href="{{ url('/teacher') }}">
                                        課程管理
                                    </a>
                                    @endcan

                                    @can('user')
                                    <a class="dropdown-item" href="{{ url('/myCourses') }}">
                                        我的課程
                                    </a>

                                    <a class="dropdown-item border-bottom" href="{{ url('/myPurchases') }}">
                                        購買紀錄
                                    </a>
                                    @endcan

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        登出
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace({width: '1.5em', height: '1.5em'})
    </script>
    <style>
        .bd-toc-link {
            display: block;
            padding: .25rem 1.5rem;
            font-weight: 600;
            color: rgba(0,0,0,0.65);
        }

        .bd-sidebar {
            position: -webkit-sticky;
            position: sticky;
            top: 4rem;
            z-index: 1000;
            height: calc(100vh - 4rem);
        }
    </style>
</body>
</html>
