@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($records))
        <p class="h2">課程</p>
            @foreach ($records as $course)
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        @if($course['image'] === null)
                            <img src="https://images.pexels.com/photos/276452/pexels-photo-276452.jpeg" class="img-thumbnail">
                        @else
                            <img src="https://104-aws-training-cicd-bucket.s3-ap-northeast-1.amazonaws.com/tzuchieh.hsieh/{{ $course['image'] }}" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <a href="/course/{{ $course['id'] }}">
                                <h5 class="card-title">{{ $course['name'] }}</h5>
                            </a>
                            <p class="card-text">{{ $course['description'] }}</p>
                                @foreach ($course['teacher'] as $teacher)
                                    <p>老師：{{ $teacher['name'] }}</p>
                                @endforeach
                            <p>價格：NT ${{ $course['price'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {!! $records->links() !!}
        @endif
    </div>
@endsection


