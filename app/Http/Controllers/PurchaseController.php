<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Purchase;
use App\Models\StudentCourse;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 購買成功流程：
     * 1. 先把購買紀錄存在purchase_record
     * 2. 刪除使用者購物車的項目
     * 3. 將購買的課程加入"學生的課程"
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $carts = User::find($userId)->cart()->get()->toArray();
        $now = Carbon::now();

        if ($carts == null) {
            abort(403);
        }

        foreach ($carts as $cart) {
            $purchaseData[] = [
                'user_id' => $cart['pivot']['user_id'],
                'course_id' => $cart['pivot']['course_id'],
                'course_name' => $cart['name'],
                'price' => $cart['price'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $cartData[] = $cart['pivot']['id'];
            $studentCourseData[] = [
                'student_id' => $cart['pivot']['user_id'],
                'course_id' => $cart['pivot']['course_id'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Purchase::insert($purchaseData);
        Cart::destroy($cartData);
        StudentCourse::insert($studentCourseData);
        return view('purchaseSuccess');
    }

    /**
     * 顯示購買成功
     *
     * @return \Illuminate\Http\Response
     */
    public function purchaseSuccess()
    {
        return view('purchaseSuccess');
    }
}
