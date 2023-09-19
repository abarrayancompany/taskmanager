<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskType;
use App\Models\User;
use Session;
use Auth;
use Validator;
use Redirect;
use Carbon\Carbon;


class TaskController extends Controller
{
    public function tasks() {
        Session::put('page','tasks');
        $tasks = Task::where('user_id',Auth::user()->id)->with('type')->get()->toArray();
        return view('tasks.tasks')->with(compact('tasks'));
    }
    public function newtask(Request $request) {
        Session::put('page','new_task');

            if ($request->isMethod("post")) {
                $data = $request->all();
                /* echo "<pre>"; print_r($data); die; */

            //Validation
            $rules = [
                'title' => 'required|max:100',
                'type' => 'required',
                'status' => 'required',
                'due_date' => 'required',
            ];

            $custommassages =[
                'title.required' => 'برای وظیفه عنوان تعریف کنید.',
                'title.max' => 'عنوان وارد شده طولانی است .',
                'type.required' => 'نوع وظیفه مشخص نشده است.',
                'status.required' => 'وضعیت وظیفه مشخص نشده است.',
                'due_date.required' => 'تاریخ مشخص نشده است.',
            ];
            $this->validate($request,$rules,$custommassages);

            //New Task
            $task = New Task;
            $task -> user_id = Auth::user()->id;
            $task -> type_id = $data['type'];
            $task -> title = $data['title'];
            $task -> description = $data['description'];
            $task -> status = $data['status'];
            $task -> due_date = $data['due_date'];
            $task -> created_at = Carbon::now();
            $task -> updated_at = Carbon::now();
            $task -> save();
            return redirect('dashboard/tasks')->with('success_message','وظیفه جدید ایجاد شد!');
    }
        //Get Task Types
        $types = TaskType::get()->toArray();
        return view('tasks.new')->with(compact('types'));
    }

    public function taskManage(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */

            if ($data['btn'] == 'completed' ) {
                Task::where('id',$data['task_id'])->update(['status'=>'completed', 'updated_at'=> Carbon::now()]);
                return redirect('dashboard/tasks')->with('success_message','وظیفه مورد نظر به اتمام رسید!');
            }elseif ($data['btn'] == 'cancel' ) {
                Task::where('id',$data['task_id'])->update(['status'=>'cancel', 'updated_at'=> Carbon::now()]);
                return redirect('dashboard/tasks')->with('success_message','وظیفه مورد نظر لغو شد!');
            }elseif ($data['btn'] == 'delete' ) {
                $Task = Task::find($data['task_id']);
                $Task->delete();
                return redirect('dashboard/tasks')->with('success_message','وظیفه مورد نظر حذف شد!');
            }

        }
    }
}