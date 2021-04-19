@extends('admin/admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-12">
                <h2 class="h2">所有學生的課程資訊</h2>
            </div>
            <div class="col-sm-2 col-12">
                <a type="button" class="btn btn-success float-right" href="{{ url('/admin/createStudentCourse/') }}">
                    <span data-feather="plus"></span> 新增
                </a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">學生編號</th>
                    <th scope="col">課程編號</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $studentCourses)
                    <tr>
                        <th scope="row">{{ $studentCourses['id'] }}</th>
                        <td>{{ $studentCourses['student_id'] }}</td>
                        <td>{{ $studentCourses['course_id'] }}</td>
                        <td>
                            <a type="button" class="btn btn-primary" data-method="put"
                                href="/admin/showUpdateStudentCourse/{{ $studentCourses['id'] }}" >
                                <span data-feather="edit-2"></span>  修改
                            </a>
                            <a type="button" class="btn btn-danger" data-method="delete"
                                href="/admin/destroyStudentCourse/{{ $studentCourses['id'] }}" >
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
        document.getElementById('student_courses').classList.add('active');
    </script>
@endsection
