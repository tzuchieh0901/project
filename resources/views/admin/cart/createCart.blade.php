@extends('admin/admin')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2 class="h2">新增購物車</h2>
        <form action="{{ url('/admin/carts') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">user_id</label>
                <input type="number" class="form-control" id="user_id" name="user_id" required="required" placeholder="請輸入user_id">
            </div>
            <div class="form-group">
                <label for="course_id">course_id</label>
                <input type="number" class="form-control" id="course_id" name="course_id" required="required" placeholder="請輸入course_id">
            </div>
            <button type="submit" class="btn btn-primary">送出</button>
        </form>
    </div>

    <script>
        document.querySelector('.active').classList.remove('active');
        document.getElementById('carts').classList.add('active');
    </script>
@endsection




