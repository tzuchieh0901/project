<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Course;

class CourseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * 測試首頁讀取頁面是否正常
     */
    public function testViewHomePage()
    {
        $response = $this->get('/');
        $response->assertViewIs('welcome');
    }

    /**
     * 測試單一課程的頁面
     */
    public function testViewCourse()
    {
        $course = Course::create([
            'name' => 'test name',
            'description' => 'description',
            'outline' => 'this is outline.',
            'price' => 500,
        ]);
        $response = $this->get("/course/{$course['id']}");
        $response->assertViewIs('course');
    }
}
