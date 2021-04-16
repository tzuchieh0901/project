@extends('admin/admin')

@section('content')
    <div class="container">
        <h2 class="h2">新增訂單</h2>
        <form action="{{ url('/admin/purchases') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">學生ID</label>
                <input type="text" class="form-control" id="user_id" name="user_id" required="required" placeholder="請輸入學生ID">
            </div>
            <div class="form-group">
                <label for="course_id">課程ID</label>
                <input type="text" class="form-control" id="course_id" name="course_id" required="required" placeholder="請輸入課程ID">
            </div>
            <div class="form-group">
                <label for="course_name">課程名稱</label>
                <input type="text" class="form-control" id="course_name" name="course_name" required="required" placeholder="請輸入課程名稱">
            </div>
            <div class="form-group">
                <label for="price">價格</label>
                <input type="text" class="form-control" id="price" name="price" required="required" placeholder="請輸入價格">
            </div>
            <button type="submit" class="btn btn-primary">送出</button>
        </form>
    </div>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('purchases').classList.add('active');
    </script>
@endsection




