<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use illuminate\foundation\auth\user as authenticatable;
use App\Models\Admin;
use App\Models\User;
use App\Models\Task;
use Validator;
use Redirect;
use Session;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;


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
        Session::put('page','dashboard');
        $tasks = Task::with('user')->get()->toArray();
        //Get Tasks count
        $task_count = Task::count();
        $in_progress_tasks = Task::where(['status'=>'in_progress'])->count();
        $completed_tasks = Task::where(['status'=>'completed'])->count();
        $canceled_task = Task::where(['status'=>'cancel'])->count();

        //get users list
        $users_count = User::count();
        $users = User::get()->toArray();

        return view('admin.dashboard')->with(compact('tasks','task_count','in_progress_tasks','completed_tasks','canceled_task','users','users_count'));
    }

    public function tasks() {
        Session::put('page','tasks');
        $tasks = Task::with('user')->get()->toArray();
        return view('admin.tasks')->with(compact('tasks'));
    }
    public function users() {
        Session::put('page','users');
        $users = User::get()->toArray();
        return view('admin.users')->with(compact('users'));
    }

    public function newUser(Request $request) {
        Session::put('page','new_user');

            if ($request->isMethod("post")) {
                $data = $request->all();
                /* echo "<pre>"; print_r($data); die;
 */
            //Validation
            $rules = [
                'name' => 'required|max:100',
                'email' => 'required|email|max:255|unique:users',
                'student_code' => 'required|unique:users',
                'user_password' => 'required',
            ];

            $custommassages =[
                'name.required' => 'وارد کردن نام الزامیست.',
                'email.required' => 'ایمیل الزامیست .',
                'email.email' => 'فرمت ایمیل صحیح نیست .',
                'email.max' => 'آدرس ایمیل بیش از حد است .',
                'email.unique' => 'این ایمیل قبلا ثبت شده است .',
                'student_code.required' => 'شماره دانشجویی الزامیست.',
                'student_code.unique' => 'این شماره دانشجویی قبلا ثبت شده است.',
                'user_password.required' => 'رمز عبور الزامیست.',
            ];
            $this->validate($request,$rules,$custommassages);


            //New User
            $user = New User;
            $user -> name = $data['name'];
            $user -> email = $data['email'];
            $user -> student_code  = $data['student_code'];
            $user -> password = bcrypt($data['user_password']);
            $user -> created_at = Carbon::now();
            $user -> updated_at = Carbon::now();
            $user -> save();
            return redirect('admin/dashboard/users')->with('success_message','کاربر جدید ایجاد شد!');
    }
        return view('admin.new_user');
    }

    public function userDelete(Request $request) {

        if ($request->isMethod("post")) {
            $data = $request->all();
            $user = user::find($data['user_id']);
                $user->delete();
                return Redirect()->back()->with('success_message','کاربر مورد نظر حذف شد!');
        }
    }

    public function admins() {
        Session::put('page','admins');
        $admins = Admin::get()->toArray();
        return view('admin.admins')->with(compact('admins'));
    }

    public function adminManage(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();
            $curren_admin_id = Auth::guard('admin')->user()->id;
            if ($data['btn'] == 'delete' ) {
                $admin = Admin::find($data['admin_id']);
                if($data['admin_id'] == $curren_admin_id) {
                    return Redirect()->back()->with('error_message','شما نمی‌توانید حساب کاربری خود را حذف کنید!');
                }else {
                    $admin->delete();
                    return Redirect()->back()->with('success_message','ادمین مورد نظر حذف شد!');
                }
            }elseif($data['btn'] == 'status0') {
                if($data['admin_id'] == $curren_admin_id) {
                    return Redirect()->back()->with('error_message','شما نمی‌توانید حساب کاربری خود را غیرفعال کنید!');
                }else {
                Admin::where('id',$data['admin_id'])->update(['status'=>0]);
                return Redirect()->back()->with('success_message','ادمین غیرفعال شد!');
                }
            }elseif($data['btn'] == 'status1') {
                Admin::where('id',$data['admin_id'])->update(['status'=>1]);
                return Redirect()->back()->with('success_message','ادمین فعال شد!');
            }
        }
    }

    public function newAdmin(Request $request) {
        Session::put('page','new_admin');

            if ($request->isMethod("post")) {
                $data = $request->all();
                /* echo "<pre>"; print_r($data); die;
 */
            //Validation
            $rules = [
                'name' => 'required|max:100',
                'email' => 'required|email|max:255|unique:admins',
                'password' => 'required',
            ];

            $custommassages =[
                'name.required' => 'وارد کردن نام الزامیست.',
                'email.required' => 'ایمیل الزامیست .',
                'email.email' => 'فرمت ایمیل صحیح نیست .',
                'email.max' => 'آدرس ایمیل بیش از حد است .',
                'email.unique' => 'این ایمیل قبلا ثبت شده است .',
                'password.required' => 'رمز عبور الزامیست.',
            ];
            $this->validate($request,$rules,$custommassages);


            //New User
            $admin = New Admin;
            $admin -> name = $data['name'];
            $admin -> email = $data['email'];
            $admin -> password = bcrypt($data['password']);
            $admin -> status = 1;
            $admin -> created_at = Carbon::now();
            $admin -> updated_at = Carbon::now();
            $admin -> save();
            return redirect('admin/dashboard/admins')->with('success_message','ادمین جدید ایجاد شد!');
    }
        return view('admin.new_admin');
    }

    //Get Users Tasks
    public function userTasks($id) {
        Session::put('page','users');
        $user_tasks = Task::where('user_id',$id)->with('user')->get()->toArray();
        $user_detail = User::where('id',$id)->get()->first();
        return view('admin.user_tasks')->with(compact('user_tasks','user_detail'));
    }



    //logout function
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
