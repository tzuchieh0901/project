@extends('admin/admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-12">
                <h2 class="h2">所有訂單資訊</h2>
            </div>
            <div class="col-sm-2 col-12">
                <a type="button" class="btn btn-success float-right" href="{{ url('/admin/createPurchase/') }}">
                    <span data-feather="plus"></span> 新增
                </a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">學生ID</th>
                <th scope="col">課程名稱</th>
                <th scope="col">價格</th>
                <th scope="col">更新時間</th>
                <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $purchase)
                    <tr>
                        <th scope="row">{{ $purchase['id'] }}</th>
                        <td>{{ $purchase['user_id'] }}</td>
                        <td>{{ $purchase['course_name'] }}</td>
                        <td>{{ $purchase['price'] }}</td>
                        <td>{{ $purchase['updated_at'] }}</td>
                        <td>
                            <a type="button" class="btn btn-primary" data-method="put"
                                href="/admin/showUpdatePurchase/{{ $purchase['id'] }}" >
                                <span data-feather="edit-2"></span>  修改
                            </a>
                            <a type="button" class="btn btn-danger" data-method="delete"
                                href="/admin/destroyPurchase/{{ $purchase['id'] }}" >
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
        document.getElementById('purchases').classList.add('active');
    </script>
@endsection
