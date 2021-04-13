@extends('layouts.app')

@section('content')
    @if (count($records))
        <div class="d-flex">
            <div class="col-md-3 col-xl-2 bd-sidebar border-right">
                <div class="row">
                    <nav class="bd-links">
                        <a class="bd-toc-link" href="#"><h3>{{ $courseName[0]['name'] }}</h3></a>
                        @foreach ($records as $course)
                            <a class="bd-toc-link" href="/classroom/{{ $course['course_id']}}/{{ $course['content_sequence']}}">
                                {{ $course['content_chapter_name'] }}
                            </a>
                        @endforeach
                    </nav>
                </div>
            </div>

            <main class="col-md-9 " role="main">
                    <h2>{{ $records[0]['content_chapter_name'] }}</h2>
                    <p>{{ $records[0]['content'] }}</p>
                    @if($records[0]['YouTube'])
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $records[0]['YouTube'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @endif
            </main>
        </div>
    @else
        <div class="container">
            <p>沒有內容</p>
        </div>
    @endif
@endsection


