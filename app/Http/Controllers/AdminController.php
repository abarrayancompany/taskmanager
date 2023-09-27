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
        $tasks = Task::with('type')->get()->toArray();
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
        $tasks = Task::with('type')->get()->toArray();
        return view('admin.tasks')->with(compact('tasks'));
    }
    public function users() {
        Session::put('page','users');
        $users = User::get()->toArray();
        return view('admin.users')->with(compact('users'));
    }

    public function userDelete(Request $request) {

        if ($request->isMethod("post")) {
            $data = $request->all();
            $user = user::find($data['user_id']);
                $user->delete();
                return Redirect()->back()->with('success_message','کاربر مورد نظر حذف شد!');
        }
    }
}
