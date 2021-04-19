@extends('admin/admin')

@section('content')
    <div class="container">
        <h2 class="h2">新增課程內容</h2>
        <form action="{{ url('/admin/courseContents') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="course_id">課程編號</label>
                <input type="number" class="form-control" id="course_id" name="course_id" required="required" placeholder="請輸入課程編號">
            </div>
            <div class="form-group">
                <label for="content_sequence">內容編號</label>
                <input type="number" class="form-control" id="content_sequence" name="content_sequence" required="required" placeholder="請輸入內容編號">
            </div>
            <div class="form-group">
                <label for="content_chapter_name">章節名稱</label>
                <input type="text" class="form-control" id="content_chapter_name" name="content_chapter_name" required="required" placeholder="請輸入章節名稱">
            </div>
            <div class="form-group">
                <label for="content">內容</label>
                <input type="text" class="form-control" id="content" name="content" required="required" placeholder="請輸入內容">
            </div>
            <div class="form-group">
                <label for="YouTube">YouTube</label>
                <input type="text" class="form-control" id="YouTube" name="YouTube" placeholder="請輸入YouTube">
            </div>
            <button type="submit" class="btn btn-primary">送出</button>
        </form>
    </div>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('courses_contents').classList.add('active');
    </script>
@endsection




