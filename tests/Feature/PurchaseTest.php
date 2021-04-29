<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Auth;
use App\Models\Purchase;
use App\Models\StudentCourse;
use App\Models\Cart;

class PurchaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * 測試購買成功
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $this->userLoginIn();

        Cart::create([
            'user_id' => Auth::id(),
            'course_id' => 2,
        ]);

        $response = $this->call('GET', '/purchase');
        $this->assertEquals(200, $response->status());
    }
}
