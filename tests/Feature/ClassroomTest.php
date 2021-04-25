<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\TeacherCourse;
use App\Models\StudentCourse;
use Auth;

class ClassroomTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * 測試老師進入教室首頁
     *
     * @return void
     */
    public function testTeacherInClassroomIndex()
    {
        $this->teacherLoginIn();
        $userId = Auth::user()->id;
        $course = Course::create([
            'name' => 'test name',
            'description' => 'description',
            'outline' => 'this is outline.',
            'price' => 500,
        ]);
        TeacherCourse::create([
            'teacher_id' => $userId,
            'course_id' => $course['id'],
        ]);

        $response = $this->get("/classroom/{$course['id']}");
        $response->assertStatus(200);
    }

    /**
     * 測試學生進入教室首頁
     *
     * @return void
     */
    public function testUserInClassroomIndex()
    {
        $this->userLoginIn();
        $userId = Auth::user()->id;
        $course = Course::create([
            'name' => 'test name',
            'description' => 'description',
            'outline' => 'this is outline.',
            'price' => 500,
        ]);
        StudentCourse::create([
            'student_id' => $userId,
            'course_id' => $course['id'],
        ]);

        $response = $this->get("/classroom/{$course['id']}");
        $response->assertStatus(200);
    }

    /**
     * 測試學生沒有購買課程進入教室首頁
     *
     * @return void
     */
    public function testUserInClassroomIndexFailed()
    {
        $this->userLoginIn();
        $userId = Auth::user()->id;
        $course = Course::create([
            'name' => 'test name',
            'description' => 'description',
            'outline' => 'this is outline.',
            'price' => 500,
        ]);

        $response = $this->get("/classroom/{$course['id']}");
        $response->assertStatus(403);
    }

    /**
     * 測試老師進入教室章節
     *
     * @return void
     */
    public function testTeacherInClassroomContent()
    {
        $this->teacherLoginIn();
        $userId = Auth::user()->id;
        $course = Course::create([
            'name' => 'test name',
            'description' => 'description',
            'outline' => 'this is outline.',
            'price' => 500,
        ]);
        TeacherCourse::create([
            'teacher_id' => $userId,
            'course_id' => $course['id'],
        ]);
        CourseContent::create([
            'course_id' => $course['id'],
            'content_sequence' => 1,
            'content_chapter_name' => '測試章節一',
            'content' => '測試內容',
        ]);

        $response = $this->get("/classroom/{$course['id']}/1");
        $response->assertStatus(200);
    }

    /**
     * 測試學生進入教室章節
     *
     * @return void
     */
    public function testUserInClassroomContent()
    {
        $this->userLoginIn();
        $userId = Auth::user()->id;
        $course = Course::create([
            'name' => 'test name',
            'description' => 'description',
            'outline' => 'this is outline.',
            'price' => 500,
        ]);
        StudentCourse::create([
            'student_id' => $userId,
            'course_id' => $course['id'],
        ]);
        CourseContent::create([
            'course_id' => $course['id'],
            'content_sequence' => 1,
            'content_chapter_name' => '測試章節一',
            'content' => '測試內容',
        ]);

        $response = $this->get("/classroom/{$course['id']}/1");
        $response->assertStatus(200);
    }

    /**
     * 測試章節不存在
     *
     * @return void
     */
    public function testNoContent()
    {
        $this->userLoginIn();
        $response = $this->get('/classroom/999/999');
        $response->assertStatus(404);
    }
}
