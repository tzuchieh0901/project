@extends('admin/admin')

@section('content')
    <div class="container">
        <h2 class="h2">新增課程</h2>
        <form action="{{ url('/courses') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">課程名稱</label>
                <input type="text" class="form-control" id="name" name="name" required="required" placeholder="請輸入課程名稱">
            </div>
            <div class="form-group">
                <label for="description">課程描述</label>
                <textarea class="form-control" id="description" name="description" rows="3" required="required" placeholder="請輸入課程描述"></textarea>
            </div>
            <div class="form-group">
                <label for="outline">課程大綱</label>
                <textarea class="form-control" id="outline" name="outline" rows="3" required="required" placeholder="請輸入課程大綱"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">送出</button>
        </form>
    </div>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('courses').classList.add('active');
    </script>
@endsection




