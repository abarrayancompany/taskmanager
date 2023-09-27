<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use illuminate\foundation\auth\user as authenticatable;
use App\Models\Admin;

class AdminController extends Controller
{
    public function login(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'status'=>1])) {
                return redirect('admin/dashboard');
            }
            else {
                return redirect()->back()->with('error_message','رمز عبور یا نام کاربری اشتباه است');
            }
        }
        return view('admin.login');
    }

    public function dashboard() {
        return view('admin.dashboard');
    }

}
