<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\Redirect;

class PurchaseController extends Controller
{
    /**
     * 後台顯示所有的訂單
     *
     * @return \Illuminate\Http\Response
     */
    public function purchaseList()
    {
        $purchases = Purchase::all()->toArray();
        $result = ['records' => $purchases];
        return view('admin/purchase/purchaseList', $result);
    }

    /**
     * 刪除訂單
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPurchase($id)
    {
        $cart = Purchase::find($id);
        $status = $cart->delete();
        return Redirect::to('/admin/purchases');
    }

    /**
     * 更新購物車資訊
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePurchase(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'course_id' => 'required|integer',
            'course_name' => 'required|string|max:100',
            'price' => 'required|integer',
        ]);

        $purchase = Purchase::find($id);
        $status = $purchase->update($validatedData);
        return Redirect::to('/admin/purchases');
    }

    /**
     * 顯示更新購物車頁面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdatePurchase($id)
    {
        $purchase = Purchase::find($id)->toArray();
        $result = ['records' => $purchase];
        return view('admin/purchase/updatePurchase', $result);
    }

    /**
     * 新增訂單頁面
     *
     * @return \Illuminate\Http\Response
     */
    public function createPurchase()
    {
        return view('admin/purchase/createPurchase');
    }

    /**
     * 儲存訂單
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePurchase(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'course_id' => 'required|integer',
            'course_name' => 'required|string|max:100',
            'price' => 'required|integer',
        ]);
        $status = Purchase::create($validatedData);
        return Redirect::to('/admin/purchases');
    }
}
