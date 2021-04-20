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
        $user = factory(User::class)->create();
        $this->be($user);
    }
}
