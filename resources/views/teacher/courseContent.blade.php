@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-12">
                <h2 class="h2">編輯課程內容</h2>
            </div>
            <div class="col-sm-2 col-12">
                <a type="button" class="btn btn-success float-right" href="/teacher/createCourseContent/{{ $courseId }}">
                    <span data-feather="plus"></span> 新增
                </a>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">課程章節名稱</th>
                    <th scope="col">課程內容</th>
                    <th scope="col">YouTube</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                @if (count($courseContent))
                    @foreach ($courseContent as $content)
                        <tr>
                            <td>{{ $content['content_sequence'] }}</td>
                            <td>{{ $content['content_chapter_name'] }}</td>
                            <td>{{ $content['content'] }}</td>
                            <td>{{ $content['YouTube'] }}</td>
                            <td>
                                <a type="button" class="btn btn-primary" data-method="put"
                                    href="/teacher/updateCourseContent/{{ $content['id'] }}" >
                                    <span data-feather="edit-2"></span>  修改
                                </a>
                                <a type="button" class="btn btn-danger" data-method="delete"
                                    href="/teacher/deleteCourseContent/{{ $content['course_id'] }}/{{ $content['id'] }}" >
                                    <span data-feather="trash-2"></span> 刪除
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection


