@extends('layouts.app')

@section('content')
    <div class="container">
        <p class="h2">購買紀錄</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">課程名稱</th>
                    <th scope="col">價格</th>
                    <th scope="col">購買日期</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $purchase)
                    <tr>
                        <td>{{ $purchase['course_name'] }}</td>
                        <td>NT ${{ $purchase['price'] }}</td>
                        <td>{{ $purchase['created_at'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


