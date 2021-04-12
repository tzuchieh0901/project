@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Dashboard</h2>
        <a href="{{ url('/teacher/courses') }}">課程管理</a>
    </div>
@endsection


