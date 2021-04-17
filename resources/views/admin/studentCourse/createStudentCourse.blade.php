@extends('admin/admin')

@section('content')
    <div class="container">
        <h2 class="h2">新增學生的課程</h2>
        <form action="{{ url('/admin/studentCourses') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="student_id">學生編號</label>
                <input type="number" class="form-control" id="student_id" name="student_id" required="required" placeholder="請輸入學生編號">
            </div>
            <div class="form-group">
                <label for="course_id">課程編號</label>
                <input type="number" class="form-control" id="course_id" name="course_id" required="required" placeholder="請輸入課程編號">
            </div>
            <button type="submit" class="btn btn-primary">送出</button>
        </form>
    </div>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('student_courses').classList.add('active');
    </script>
@endsection




