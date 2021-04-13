@extends('admin/admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-12">
                <h2 class="h2">所有購物車資訊</h2>
            </div>
            <div class="col-sm-2 col-12">
                <a type="button" class="btn btn-success float-right" href="{{ url('/admin/createCart/') }}">
                    <span data-feather="plus"></span> 新增
                </a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">user_id</th>
                <th scope="col">course_id</th>
                <th scope="col">更新時間</th>
                <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $carts)
                    <tr>
                        <th scope="row">{{ $carts['id'] }}</th>
                        <td>{{ $carts['user_id'] }}</td>
                        <td>{{ $carts['course_id'] }}</td>
                        <td>{{ $carts['updated_at'] }}</td>
                        <td>
                            <a type="button" class="btn btn-primary" data-method="put"
                                href="/admin/showUpdateCart/{{ $carts['id'] }}" >
                                <span data-feather="edit-2"></span>  修改
                            </a>
                            <a type="button" class="btn btn-danger" data-method="delete"
                                href="/admin/destroyCart/{{ $carts['id'] }}" >
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
        document.getElementById('carts').classList.add('active');
    </script>
@endsection
