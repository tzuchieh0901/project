
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">104線上學校</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('home') }}">
                        回首頁
                    </a>
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
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link dashboard active" id="dashboard" href="{{ url('/admin/dashboard') }}">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="courses" href="{{ url('/admin/courses/') }}">
                            <span data-feather="book"></span>
                            課程資訊
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="courses_contents" href="{{ url('/admin/courseContents/') }}">
                            <span data-feather="book-open"></span>
                            課程內容
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="students" href="{{ url('/admin/students/') }}">
                            <span data-feather="users"></span>
                            學生
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="student_courses" href="{{ url('/admin/studentCourses/') }}">
                            <span data-feather="shopping-bag"></span>
                            學生的課程
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="teachers" href="{{ url('/admin/teachers/') }}">
                            <span data-feather="feather"></span>
                            老師
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="teacher_courses" href="{{ url('/admin/teacherCourses/') }}">
                            <span data-feather="archive"></span>
                            老師的課程
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="carts" href="{{ url('/admin/carts/') }}">
                            <span data-feather="shopping-cart"></span>
                            購物車
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="purchases" href="{{ url('/admin/purchases/') }}">
                            <span data-feather="credit-card"></span>
                            訂單
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @yield('content')
        </main>
    </div>


    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
<style>
.my-card
{
    position:absolute;
    left:40%;
    top:-20px;
    border-radius:50%;
}
</style>
</body>
</html>
