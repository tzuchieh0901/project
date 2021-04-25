<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 模擬使用者登入
     *
     * @return void
     */
    protected function userLoginIn()
    {
        $user = User::create([
            'name' => '王新一',
            'role' => 'user',
            'email' => 'user@user.com',
            'password' => '@xfc*cdddsmjm',
        ]);
        $this->be($user);
    }

    /**
     * 模擬老師登入
     *
     * @return void
     */
    protected function teacherLoginIn()
    {
        $user = User::create([
            'name' => '王老師',
            'role' => 'teacher',
            'email' => 'teacher@teacher.com',
            'password' => '@xfc*cf9cxsmjm',
        ]);
        $this->be($user);
    }
}
