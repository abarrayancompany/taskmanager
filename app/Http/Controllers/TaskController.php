<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskType;
use App\Models\User;
use Session;
use Auth;


class TaskController extends Controller
{
    public function tasks() {
        Session::put('page','tasks');
        return view('tasks.tasks');
    }
    public function newtask(Request $request) {
        Session::put('page','new_task');

            if ($request->isMethod("post")) {
                $data = $request->all();
                echo "<pre>"; print_r($data); die;

            if (!empty($data['accept'])) {
            //Validation
            $rules = [
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:150|unique:users',
                'password' => 'required|min:6',
                'accept' => 'required',
            ];

            $customMessages =[
                'name.required' => 'لطفا نام خود را وارد کنید.',
                'name.string' => 'نام وارد شده صحیح نیست.',
                'name.max' => 'نام وارد شده طولانی است .',
                'email.required' => 'وارد کردن ایمیل الزامیست.',
                'email.email' => 'فرمت وارد شده برای ایمیل صحیح نیست.',
                'email.max' => 'آدرس ایمیل بیش از حد طولانی است.',
                'email.unique' => 'این ایمیل قبلا ثبت شده است.',
                'password.required' => 'برای حساب کاربری خود رمز عبور تعین کنید.',
                'password.min' => 'حداقل کاراکتر مجاز برای رمز عبور 6 کاراکتر می‌باشد.',
                'accept.required' => 'لطفا شرایط و قوانین عضویت در سایت را مطالعه و تایید کنید.',
            ];
            $validator = Validator::make($data,$rules,$customMessages);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
        }
    }
        //Get Task Types
        $types = TaskType::get()->toArray();
        return view('tasks.new')->with(compact('types'));
    }
}
