@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($records))
        <p class="h2">課程</p>
            @foreach ($records as $course)
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="https://images.pexels.com/photos/276452/pexels-photo-276452.jpeg" class="img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <a href="/course/{{ $course['id'] }}">
                                <h5 class="card-title">{{ $course['name'] }}</h5>
                            </a>
                            <p class="card-text">{{ $course['description'] }}</p>
                            <p>NT $999</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
@endsection

