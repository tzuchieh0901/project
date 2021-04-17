@extends('layouts.app')

@section('content')
<div class="container">
    @can('admin')
        <p>Hello ~ 系統管理者</p>
    @elsecan('user')
        <p>Hello ~ 學生</p>
    @elsecan('teacher')
        <p>Hello ~ 老師</p>
    @else
        <div class="container py-8">
            <div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/bg.jpg); height: 600px;">
                <div class="justify-content-left">
                    <h2 class="mb-4">
                        歡迎！
                    </h2>
                    <h2 class="mb-4">
                        來到104線上學校
                    </h2>
                    <p class="mb-4">
                        開始您的學習！
                    </p>
                </div>
                <a href="/courses" class="btn btn-primary">查看更多課程</a>
            </div>
        </div>
    @endcan
</div>
@endsection


