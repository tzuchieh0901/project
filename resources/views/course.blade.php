@extends('layouts.app')

@section('content')
    <div class="container"> 
        <img src="https://images.pexels.com/photos/276452/pexels-photo-276452.jpeg" style="height: 200px;width: 100%;">
        @if (count($records))
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h3 class="card-title">{{ $records['name'] }}</h3>
                            <p class="card-text">課程描述：{{ $records['description'] }}</p>
                            <p class="card-text">課程大綱：{{ $records['outline'] }}</p>
                            <p class="card-text">最近更新時間：{{ $records['updated_at'] }}</p>
                            <p>價格：NT $999</p>
                            <button type="button" class="btn btn-primary">放入購物車</button>
                            <button type="button" class="btn btn-outline-primary">立即購買</button>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


