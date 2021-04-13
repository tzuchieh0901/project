@extends('admin/admin')

@section('content')
    <div class="container">
        <div>
            <h2 class="h2">Dashboard</h2>
        </div>

        <div class="row w-100" style="top: 20px;">
            <div class="col-md-3" style="top: 20px;">
                <div class="card border-info mx-sm-1 p-3">
                    <div class="card border-info shadow text-info p-3 my-card" ><span data-feather="book-open" class="fa fa-car" aria-hidden="true"></span></div>
                    <div class="text-info text-center mt-3"><h4>課程</h4></div>
                    <div class="text-info text-center mt-2"><h1>{{ $courseCount }}門</h1></div>
                </div>
            </div>
            <div class="col-md-3" style="top: 20px;">
                <div class="card border-success mx-sm-1 p-3">
                    <div class="card border-success shadow text-success p-3 my-card"><span data-feather="users"></span></div>
                    <div class="text-success text-center mt-3"><h4>學生</h4></div>
                    <div class="text-success text-center mt-2"><h1>{{ $studentCount }}位</h1></div>
                </div>
            </div>
            <div class="col-md-3" style="top: 20px;">
                <div class="card border-danger mx-sm-1 p-3">
                    <div class="card border-danger shadow text-danger p-3 my-card" ><span data-feather="feather"></span></div>
                    <div class="text-danger text-center mt-3"><h4>老師</h4></div>
                    <div class="text-danger text-center mt-2"><h1>{{ $teacherCount }}位</h1></div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('dashboard').classList.add('active');
    </script>
@endsection




