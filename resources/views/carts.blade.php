@extends('layouts.app')

@section('content')
    <div class="container">
        <p class="h2">購物車</p>
        @if (count($records))
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th scope="col">課程名稱</th>
                    <th scope="col">價格</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($records as $course)
                    <tr>
                        <td>
                            @if($course['image'])
                                <img src="https://104-aws-training-cicd-bucket.s3-ap-northeast-1.amazonaws.com/tzuchieh.hsieh/{{ $course['image'] }}" style="width:160px; height:80px;">
                            @else
                                <img src="https://images.pexels.com/photos/276452/pexels-photo-276452.jpeg" style="width:160px; height:80px;">
                            @endif
                        </td>
                        <td>{{ $course['name'] }}</td>
                        <td>NT ${{ $course['price'] }}</td>
                        <td>
                            <a href="/removeCartItem/{{$course['pivot']['id']}}">
                                <button class="btn btn-sm btn-danger">
                                    <span data-feather="trash-2"></span>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>總額</strong></td>
                        <td><strong>NT ${{ $sum }}</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="{{ url('/courses') }}">
                            <button class="btn btn-block btn-light">繼續選購</button>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <a href="{{ url('/purchase') }}">
                            <button class="btn btn-lg btn-block btn-success">付款</button>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <p>你的購物車沒有課程</p>
        @endif
    </div>
@endsection


