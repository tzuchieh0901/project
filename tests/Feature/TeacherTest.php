<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * 測試index
     * @return void
     */
    public function testIndex()
    {
        $this->teacherLoginIn();
        $response = $this->get('teacher');
        $response->assertStatus(200);
    }

    /**
     * 測試新建課程頁面
     * @return void
     */
    public function testCreateCourses()
    {
        $this->teacherLoginIn();
        $response = $this->get('teacher/createCourse');
        $response->assertStatus(200);
    }

    /**
     * 測試老師教授的課程
     * @return void
     */
    public function testCoursesList()
    {
        $this->teacherLoginIn();
        $response = $this->get('teacher/courses');
        $response->assertStatus(200);
    }
}
