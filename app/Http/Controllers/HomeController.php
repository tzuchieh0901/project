<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Cart;
use App\Models\Purchase;
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        return Redirect::to('/');
    }

    /**
     * 顯示學生擁有的課程
     *
     * @return \Illuminate\Http\Response
     */
    public function myCourse()
    {
        $userId = Auth::user()->id;
        $myCourses = User::find($userId)->courses()->get()->toArray();
        $result = ['records' => $myCourses];
        return view('myCourses', $result);
    }

    /**
     * 顯示購買紀錄
     *
     * @return \Illuminate\Http\Response
     */
    public function myPurchases()
    {
        $userId = Auth::user()->id;
        $purchase = Purchase::where('user_id', '=', $userId)->get()->toArray();
        $result = ['records' => $purchase];
        return view('myPurchases', $result);
    }

    /**
     * 顯示購物車頁面
     */
    public function carts()
    {
        $userId = Auth::user()->id;
        $carts = User::find($userId)->cart()->get()->toArray();
        $sum = 0;
        foreach ($carts as $cart) {
            $sum += $cart['price'];
        }

        $result = [
            'records' => $carts,
            'sum' => $sum,
        ];
        return view('carts', $result);
    }

    /**
     * 移除購物車的項目
     */
    public function removeCartItem($id)
    {
        $Cart = Cart::find($id);
        $Cart->delete();
        return Redirect::to('/carts');
    }

    /**
     * 新增購物車的項目
     */
    public function addCartItem($course_id)
    {
        $userId = Auth::user()->id;

        // 如果有存在這一筆資料，就直接跳轉頁面到購物車
        $isTrue = Cart::where('user_id', '=', $userId)->where('course_id', '=', $course_id)->get()->toArray();
        if ($isTrue) {
            return Redirect::to('/carts');
        }

        $cartForm = [
            'user_id' => $userId,
            'course_id' => $course_id,
        ];
        $status = Cart::create($cartForm);

        return Redirect::to('/carts');
    }
}
