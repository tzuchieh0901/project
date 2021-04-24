<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Purchase;
use App\Models\StudentCourse;

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

        $response = Purchase::insert([
            'id' => 1000,
            'user_id' => 55688,
            'course_id' => 2,
            'course_name' => '測試課程',
            'price' => 500,
            'created_at' => '2021-04-21 11:35:06',
            'updated_at' => '2021-04-21 11:35:06',
        ]);

        $purchase = count(Purchase::where('id', '=', 1000)->get());

        $this->assertEquals(1, $purchase);
    }
}
