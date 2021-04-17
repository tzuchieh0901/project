@extends('admin/admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-12">
                <h2 class="h2">所有老師的課程</h2>
            </div>
            <div class="col-sm-2 col-12">
                <a type="button" class="btn btn-success float-right" href="{{ url('/admin/createTeacherCourse/') }}">
                    <span data-feather="plus"></span> 新增
                </a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">老師編號</th>
                    <th scope="col">課程編號</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $teacherCourses)
                    <tr>
                        <th scope="row">{{ $teacherCourses['id'] }}</th>
                        <td>{{ $teacherCourses['teacher_id'] }}</td>
                        <td>{{ $teacherCourses['course_id'] }}</td>
                        <td>
                            <a type="button" class="btn btn-primary" data-method="put"
                                href="/admin/showUpdateTeacherCourse/{{ $teacherCourses['id'] }}" >
                                <span data-feather="edit-2"></span>  修改
                            </a>
                            <a type="button" class="btn btn-danger" data-method="delete"
                                href="/admin/destroyTeacherCourse/{{ $teacherCourses['id'] }}" >
                                <span data-feather="trash-2"></span> 刪除
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('teacher_courses').classList.add('active');
    </script>
@endsection
