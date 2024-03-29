@extends('admin/admin')

@section('content')
    <div class="container">
        <h2 class="h2">修改學生資訊</h2>
        <form action="/admin/updateStudent/{{ $records['id'] }}" method="put">
            @csrf
            <div class="form-group">
                <label for="name">學生名稱</label>
                <input type="text" class="form-control" id="name" name="name" required="required" placeholder="請輸入學生名稱" value="{{ $records['name']}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required="required" placeholder="請輸入email" value="{{ $records['email']}}">
            </div>
            <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" id="password" name="password" required="required" placeholder="請輸入密碼">
            </div>

            <button type="submit" class="btn btn-primary">送出</button>
        </form>
    </div>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('students').classList.add('active');
    </script>
@endsection
