@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($records))
        <p class="h2">我的課程</p>
            @foreach ($records as $course)
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        @if($course['image'])
                            <img src="{{ asset($course['image']) }}" style="height: 200px;width: 100%;">
                        @else
                            <img src="https://images.pexels.com/photos/276452/pexels-photo-276452.jpeg" style="height: 200px;width: 100%;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course['name'] }}</h5>
                            <p class="card-text">{{ $course['description'] }}</p>
                            <button class="btn btn-primary">去上課</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
@endsection


