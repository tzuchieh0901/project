@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="h2">新增課程內容</h2>
        <form action="/teacher/storeCourseContent/{{ $courseId }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="hidden" class="form-control" id="course_id" name="course_id" value="{{ $courseId }}">
            </div>
            <div class="form-group">
                <label for="content_sequence">章節ID</label>
                <input type="text" class="form-control" id="content_sequence" name="content_sequence" required="required" placeholder="請輸入章節ID">
            </div>
            <div class="form-group">
                <label for="content_chapter_name">章節名稱</label>
                <input type="text" class="form-control" id="content_chapter_name" name="content_chapter_name" required="required" placeholder="請輸入章節名稱">
            </div>
            <div class="form-group">
                <label for="content">課程內容</label>
                <textarea class="form-control" id="content" name="content" rows="3" required="required" placeholder="請輸入課程內容"></textarea>
            </div>
            <div class="form-group">
                <label for="YouTube">YouTube</label>
                <input type="text" class="form-control" id="YouTube" name="YouTube" placeholder="請輸入YouTube">
            </div>
            <button type="submit" class="btn btn-primary">送出</button>
        </form>
    </div>
@endsection


