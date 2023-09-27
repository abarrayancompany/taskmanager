@extends('layouts.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">داشبورد</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">داشبورد</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">{{$task_count}} وظیفه ایجاد شده</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{url('dashboard/tasks')}}">مشاهده لیست</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">{{$users_count}} کاربر فعال</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{url('dashboard/tasks')}}">مشاهده لیست</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">{{$completed_tasks}} وظیفه تکمیل شده</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{url('dashboard/tasks')}}">مشاهده لیست</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">{{$canceled_task}} وظیفه لغو شده</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{url('dashboard/tasks')}}">مشاهده لیست</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        لیست کل وظایف
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple2">
                            <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>نوع</th>
                                    <th>نام کاربر</th>
                                    <th>تاریخ انجام</th>
                                    <th>وضعیت</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>نوع</th>
                                    <th>نام کاربر</th>
                                    <th>تاریخ انجام</th>
                                    <th>وضعیت</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($tasks as $task )
                                <tr>
                                    <td><a type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$task['description']}}">
                                            {{$task['title']}}
                                    </a>
                                    </td>
                                    <td>{{$task['type']['name']}}</td>
                                    <td>{{$task['user']['name']}}</td>
                                    <td>{{$task['due_date']}}</td>
                                    <td>
                                        @if ($task['status'] == 'in_progress' )
                                        <span class="badge bg-info text-dark">در حال انجام</span>
                                        @elseif ($task['status'] == 'pending' )
                                        <span class="badge bg-warning text-dark">در انتظار بررسی</span>
                                        @elseif ($task['status'] == 'completed' )
                                        <span class="badge bg-success">تکمیل شده</span>
                                        @elseif ($task['status'] == 'cancel' )
                                        <span class="badge bg-danger">لغو شده</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
            </div>
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        آخرین کاربران
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>نام کاربر</th>
                                    <th>شماره دانشجویی</th>
                                    <th>ایمیل</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>نام کاربر</th>
                                    <th>شماره دانشجویی</th>
                                    <th>ایمیل</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $user )
                                <tr>
                                    <td>{{$user['name']}}</td>
                                    <td>{{$user['student_code']}}</td>
                                    <td>{{$user['email']}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</main>
@endsection
