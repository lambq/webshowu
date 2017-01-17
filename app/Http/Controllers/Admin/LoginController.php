<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/customer/service/coordinate/referral/new';
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
        $this->username = config('admin.global.username');
    }
    /*
     * 重写登陆视图页面
     */
    public function showLoginForm(){
        return view('admin.login.index');
    }
    /*
     * 自定义认证驱动
     */
    public function guard(){
        return auth()->guard('admin');
    }
}
