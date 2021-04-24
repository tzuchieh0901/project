<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * 測試使用者沒登入，進入我的課程會導向登入
     */
    public function testUserIsLogin()
    {
        $response = $this->get('/myCourses');
        $response->assertLocation('/login');
    }
}
