<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
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
}
