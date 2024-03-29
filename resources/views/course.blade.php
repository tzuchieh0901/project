@extends('layouts.app')

@section('content')
    <div class="container">
        @if($records['image'])
            <img src="https://104-aws-training-cicd-bucket.s3-ap-northeast-1.amazonaws.com/tzuchieh.hsieh/{{ $records['image'] }}" style="height: 200px;width: 100%;">
        @else
            <img src="https://images.pexels.com/photos/276452/pexels-photo-276452.jpeg" style="height: 200px;width: 100%;">
        @endif
        @if (count($records))
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h3 class="card-title">{{ $records['name'] }}</h3>
                            <p class="card-text">課程描述：<pre>{{ $records['description'] }}</pre></p>
                            <p class="card-text">課程大綱：<pre>{{ $records['outline'] }}</pre></p>
                            <p class="card-text">最近更新時間：{{ $records['updated_at'] }}</p>
                            <p>價格：NT ${{ $records['price'] }}</p>
                            @can('admin')
                                <a href="/classroom/{{ $records['id']}}">
                                    <button class="btn btn-primary">去上課</button>
                                </a>
                            @elsecan('user')
                                @if ( $haveCourse == true)
                                    <a href="/classroom/{{ $records['id']}}">
                                        <button class="btn btn-primary">去上課</button>
                                    </a>
                                @else
                                    <a href="/addCartItem/{{ $records['id'] }}">
                                        <button type="button" class="btn btn-primary">
                                            <span data-feather="shopping-cart"></span>   放入購物車
                                        </button>
                                    </a>
                                @endif
                            @elsecan('teacher')
                            @else
                                <a href="/addCartItem/{{ $records['id'] }}">
                                    <button type="button" class="btn btn-primary">
                                        <span data-feather="shopping-cart"></span>   放入購物車
                                    </button>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


