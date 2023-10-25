<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\File;
use App\Models\User;
use Session;
use Auth;
use Validator;
use Redirect;
use Carbon\Carbon;
use \Intervention\Image\Facades\Image;
use Hekmatinasser\Verta\Verta;


class TaskController extends Controller
{
    public function tasks() {
        Session::put('page','tasks');
        $tasks = Task::where('user_id',Auth::user()->id)->get()->toArray();
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
                'status' => 'required',
            ];

            $custommassages =[
                'title.required' => 'برای وظیفه عنوان تعریف کنید.',
                'title.max' => 'عنوان وارد شده طولانی است .',
                'status.required' => 'وضعیت وظیفه مشخص نشده است.',
            ];
            $this->validate($request,$rules,$custommassages);


            //New Task
            $task = New Task;
            $task -> user_id = Auth::user()->id;
            $task -> title = $data['title'];
            $task -> description = $data['description'];
            $task -> status = $data['status'];
            $task -> due_date = null;
            $task -> created_at = Carbon::now();
            $task -> updated_at = Carbon::now();
            $task -> save();

            // upload Task Image
            if (!empty($data['file'])) {
            $files = $data['file'];
            foreach ($files as $file) {
                $image_tmp = $file;
                if($image_tmp->isValid()){
                    //get image extention
                    $extention = $image_tmp->getClientOriginalExtension();
                    //generete New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $imagePath = 'images/tasks/'.$imageName;
                    //upload image
                    Image::make($image_tmp)->save($imagePath);
                }
            $file = New File;
            $file -> task_id = $task->id;
            $file -> file = $imageName;
            $file -> created_at = Carbon::now();
            $file -> updated_at = Carbon::now();
            $file -> save();
            }
        }
            return Redirect()->back()->with('success_message','وظیفه جدید ایجاد شد!');
    }
        return view('tasks.new');
    }

    public function taskManage(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */

            if ($data['btn'] == 'completed' ) {
                Task::where('id',$data['task_id'])->update(['status'=>'completed', 'updated_at'=> Carbon::now()]);
                return Redirect()->back()->with('success_message','وظیفه مورد نظر به اتمام رسید!');
            }elseif ($data['btn'] == 'cancel' ) {
                Task::where('id',$data['task_id'])->update(['status'=>'cancel', 'updated_at'=> Carbon::now()]);
                return Redirect()->back()->with('success_message','وظیفه مورد نظر لغو شد!');
            }elseif ($data['btn'] == 'delete' ) {
                $Task = Task::find($data['task_id']);
                $Task->delete();
                return Redirect()->back()->with('success_message','وظیفه مورد نظر حذف شد!');
            }

        }
    }

    public function filesIndex($id){
        $task = Task::find($id);
        $taskFiles = File::where('task_id',$id)->get()->toArray();
        /* dd($productFile); */
        return view('tasks.files')->with(compact('task','taskFiles'));
    }

    public function fileUpload(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */
            // upload Task Image
            if (!empty($data['file'])) {
            $files = $data['file'];
            foreach ($files as $file) {
                $image_tmp = $file;
                if($image_tmp->isValid()){
                    //get image extention
                    $extention = $image_tmp->getClientOriginalExtension();
                    //generete New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $imagePath = 'images/tasks/'.$imageName;
                    //upload image
                    Image::make($image_tmp)->save($imagePath);
                }
            $file = New File;
            $file -> task_id = $data['task_id'];
            $file -> file = $imageName;
            $file -> created_at = Carbon::now();
            $file -> updated_at = Carbon::now();
            $file -> save();
            }
        }
            return Redirect()->back()->with('success_message','بارگزاری فایل ها انجام شد!');

        }

    }
}
