
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
    <style>
        body {
            font-size: .875rem;
        }
        
        .feather {
            width: 16px;
            height: 16px;
            vertical-align: text-bottom;
        }
        
        /*
        * Sidebar
        */
        
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100; /* Behind the navbar */
            padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        
        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 48px; /* Height of navbar */
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
        
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }
        
        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }
        
        .sidebar .nav-link.active {
            color: #007bff;
        }
        
        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }
        
        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }
        
        /*
        * Navbar
        */
        
        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }
        
        .navbar .form-control {
            padding: .75rem 1rem;
            border-width: 0;
            border-radius: 0;
        }
        
        .form-control-dark {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
            border-color: rgba(255, 255, 255, .1);
        }
        
        .form-control-dark:focus {
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }
        
        /*
        * Utilities
        */
        
        .border-top { border-top: 1px solid #e5e5e5; }
        .border-bottom { border-bottom: 1px solid #e5e5e5; }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Laravel</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                    <a class="nav-link" href="#">
                        <span data-feather="home"></span>
                        Dashboard <span class="sr-only">(current)</span>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/admin/courses/') }}">
                        <span data-feather="book-open"></span>
                        Courses
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="users"></span>
                        Students
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="feather"></span>
                        Teachers
                    </a>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-12">
                        <h2 class="h2">所有課程</h2>
                    </div>
                    <div class="col-sm-2 col-12">
                        <a type="button" class="btn btn-success float-right" href="{{ url('/admin/createCourse/') }}">
                            <span data-feather="plus"></span> 新增
                        </a>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">課程名稱</th>
                        <th scope="col">更新時間</th>
                        <th scope="col">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $course)
                            <tr>
                                <th scope="row">{{ $course['id'] }}</th>
                                <td>{{ $course['name'] }}</td>
                                <td>{{ $course['updated_at'] }}</td>
                                <td>
                                    <a type="button" class="btn btn-primary" data-method="put" 
                                        href="/admin/showUpdateCourse/{{ $course['id'] }}" >
                                        <span data-feather="edit-2"></span>  修改
                                    </a>
                                    <a type="button" class="btn btn-danger" data-method="delete" 
                                        href="/admin/destroyCourse/{{ $course['id'] }}" >
                                        <span data-feather="trash-2"></span> 刪除
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

   
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

</body>
</html>