<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    /**
     * 後台顯示所有的購物車
     *
     * @return \Illuminate\Http\Response
     */
    public function cartsList()
    {
        $carts = Cart::all()->toArray();
        $result = ['records' => $carts];
        return view('admin/cart/cartList', $result);
    }

    /**
     * 刪除購物車
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCart($id)
    {
        $cart = Cart::find($id);
        $status = $cart->delete();
        return Redirect::to('/admin/carts');
    }

    /**
     * 更新購物車資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request, $id)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $cart = Cart::find($id);
        $status = $cart->update($validatedData);
        return Redirect::to('/admin/carts');
    }

    /**
     * 顯示更新購物車頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdateCart($id)
    {
        $cart = Cart::find($id)->toArray();
        $result = ['records' => $cart];
        return view('admin/cart/updateCart', $result);
    }

    /**
     * 新增購物車頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createCart()
    {
        return view('admin/cart/createCart');
    }

    /**
     * 儲存購物車
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCart(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);
        $status = Cart::create($validatedData);
        return Redirect::to('/admin/carts');
    }
}
