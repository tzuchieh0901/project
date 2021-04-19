@extends('admin/admin')

@section('content')
    <div class="container">
        <h2 class="h2">修改老師的課程資訊</h2>
        <form action="/admin/updateTeacherCourse/{{ $records['id'] }}" method="put">
            @csrf
            <div class="form-group">
                <label for="teacher_id">老師編號</label>
                <input type="number" class="form-control" id="teacher_id" name="teacher_id"
                    required="required" placeholder="請輸入老師編號" value="{{ $records['teacher_id'] }}">
            </div>
            <div class="form-group">
                <label for="course_id">課程編號</label>
                <input type="number" class="form-control" id="course_id" name="course_id"
                    required="required" placeholder="請輸入課程編號" value="{{ $records['course_id'] }}">
            </div>
            <button type="submit" class="btn btn-primary">送出</button>
        </form>
    </div>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('teacher_courses').classList.add('active');
    </script>
@endsection
