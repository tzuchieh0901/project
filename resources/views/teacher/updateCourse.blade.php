@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="h2">修改課程</h2>
        <form action="/teacher/updateCourse/{{ $records['id'] }}" method="put">
            @csrf
            <div class="form-group">
                <label for="name">課程名稱</label>
                <input type="text" class="form-control" id="name" name="name" required="required" placeholder="請輸入課程名稱" value="{{ $records['name']}}">
            </div>
            <div class="form-group">
                <label for="description">課程描述</label>
                <textarea class="form-control" id="description" name="description" rows="3" required="required" placeholder="請輸入課程描述">{{ $records['description'] }}</textarea>
            </div>
            <div class="form-group">
                <label for="outline">課程大綱</label>
                <textarea class="form-control" id="outline" name="outline" rows="3" required="required" placeholder="請輸入課程大綱">{{ $records['outline'] }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">課程售價</label>
                <textarea class="form-control" id="price" name="price" rows="3" required="required" placeholder="請輸入課程售價">{{ $records['price'] }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">送出</button>
            <a href='{{ url('/teacher/courses') }}'>
                <button type="submit" class="btn btn-link">取消</button>
            </a>
        </form>
    </div>
@endsection