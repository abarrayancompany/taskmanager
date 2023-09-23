<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Validator;
use Redirect;
use Auth;
use Session;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;


class DashboardController extends Controller
{
    public function index () {
        Session::put('page','dashboard');
        if(Auth::check()) {
        $tasks = Task::where('user_id',Auth::user()->id)->with('type')->get()->toArray();
        $now = Verta::now()->format('Y-n-j');
        $today_tasks = Task::where(['user_id'=>Auth::user()->id,'due_date'=>$now])->count();
        $today_tasks_items = Task::with('type')->where(['user_id'=>Auth::user()->id,'due_date'=>$now])->get()->toArray();
        //Get Tasks count
        $task_count = Task::where('user_id',Auth::user()->id)->count();
        $in_progress_tasks = Task::where(['user_id'=>Auth::user()->id,'status'=>'in_progress'])->count();
        $completed_tasks = Task::where(['user_id'=>Auth::user()->id,'status'=>'completed'])->count();
        $canceled_task = Task::where(['user_id'=>Auth::user()->id,'status'=>'cancel'])->count();
        return view('dashboard')->with(compact('tasks','task_count','in_progress_tasks','completed_tasks','canceled_task','today_tasks_items'));
        }else {
        return view('index');
        }
    }

    public function loginRegister(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */

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

            // Register the User
            $user = New user;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                return redirect('dashboard');
            }

        }else {
             //Validation
             $rules = [
                'email' => 'required|email|max:150|exists:users',
                'password' => 'required',
            ];

            $customMessages =[
                'email.required' => 'وارد کردن ایمیل الزامیست.',
                'email.exists' => 'حساب کاربری برای ایمیل وارد شده وجود ندارد.',
                'email.email' => 'فرمت وارد شده برای ایمیل صحیح نیست.',
                'email.max' => 'آدرس ایمیل بیش از حد طولانی است.',
                'password.required' => 'رمز عبور ورود به سیستم را وارد کنید.',
            ];
            $validator = Validator::make($data,$rules,$customMessages);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                return redirect('dashboard');
            }else {
                $massage = 'نام کاربری یا رمز عبور وارد شده اشتباه است!';
                return Redirect::back()->withErrors($massage);
            }
        }
    }
}
public function login(Request $request) {
    if ($request->isMethod("post")) {
        $data = $request->all();
        echo "<pre>"; print_r($data); die;

         //Validation
         $rules = [
            'student_code' => 'required|number|exists:users',
            'password' => 'required',
        ];

        $customMessages =[
            'student_code.required' => 'وارد کردن شماره دانشجویی الزامیست.',
            'student_code.exists' => 'حساب کاربری برای شماره دانشجویی وارد شده وجود ندارد.',
            'student_code.number' => 'شماره داشنجویی باید عددی باشد.',
            'password.required' => 'رمز عبور ورود به سیستم را وارد کنید.',
        ];
        $validator = Validator::make($data,$rules,$customMessages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if(Auth::attempt(['student_code'=>$data['student_code'],'password'=>$data['password']])) {
            return redirect('dashboard');
        }else {
            $massage = 'نام کاربری یا رمز عبور وارد شده اشتباه است!';
            return Redirect::back()->withErrors($massage);
        }
    }
}

    //logout
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
