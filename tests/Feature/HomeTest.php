<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Auth;
use Tests\Feature\Log;
use App\Models\Cart;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * 測試購物車頁面
     * @return void
     */
    public function testViewCart()
    {
        $this->userLoginIn();

        $response = $this->get('/carts');
        $response->assertStatus(200);
    }

    /**
     * 測試使用者新增購物車成功
     *
     * @return void
     */
    public function testUserCreateCartSuccess()
    {
        $this->userLoginIn();
        $cart = Cart::create([
            'id' => '2',
            'user_id' => '2',
            'course_id' => '1',
        ]);
        $response = $this->call('GET', '/addCartItem/2', [
            'id' => '2',
            'user_id' => '2',
            'course_id' => '1',
        ]);
        $this->assertEquals(302, $response->status());
    }

    /**
     * 測試使用者新增購物車失敗
     *
     * @return void
     */
    public function testUserCreateCartFailed()
    {
        $this->userLoginIn();
        $cart = Cart::create([
            'user_id' => '2',
            'course_id' => '1',
        ]);

        $response = $this->call('GET', '/addCartItem/2', [
            'user_id' => '2',
            'course_id' => '1',
        ]);

        $this->assertEquals(302, $response->status());
    }

    /**
     * 測試使用者刪除購物車成功
     *
     * @return void
     */
    public function testUserDestroyCartSuccess()
    {
        $this->userLoginIn();
        $cart = Cart::create([
            'id' => '1',
            'user_id' => '2',
            'course_id' => '1',
        ]);
        $response = $this->call('GET', '/removeCartItem/1');
        $this->assertEquals(302, $response->status());
    }

    /**
     * 測試使用者刪除購物車失敗
     *
     * @return void
     */
    public function testUserDestroyCartFailed()
    {
        $this->userLoginIn();
        $response = $this->call('GET', '/removeCartItem/9999');
        $this->assertEquals(500, $response->status());
    }
}
