@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="icon-box">
                    <span data-feather="check-circle"></span>
                </div>
            </div>
            <div class="modal-body text-center">
                <h4>購買成功！</h4>
                <p>趕快開始您的學習吧！</p>
                <a href="{{ url('/myCourses') }}">
                    <button class="btn btn-success">
                        前往我的課程<span data-feather="arrow-right"></span>
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection



