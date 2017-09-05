<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use \App\School;

class SchoolController extends Controller
{
    public function index()
    {
        \DB::enableQueryLog();
        $schools = School::orderBy('created_at', 'desc')->paginate();

//        dd(\DB::getQueryLog());
        return view('/admin/school/index', compact('schools'));
    }

    /*
     * 具体登陆
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'password' => 'required|min:6|max:30',
        ]);

        $user = request(['name', 'password']);
        if (true == \Auth::guard('admin')->attempt($user)) {
            return redirect('/admin/home');
        }

        return \Redirect::back()->withErrors("用户名密码错误");
    }

    /*
     * 登出操作
     */
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
