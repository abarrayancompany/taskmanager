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
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">{{$in_progress_tasks}} وظیفه در حال انجام</div>
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
                        وظایف امروز
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>نوع</th>
                                    <th>وضعیت</th>
                                    <th>اقدام</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>نوع</th>
                                    <th>وضعیت</th>
                                    <th>اقدام</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($today_tasks_items as $task )
                                <tr>
                                    <td><a type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$task['description']}}">
                                            {{$task['title']}}
                                    </a>
                                    </td>
                                    <td>{{$task['type']['name']}}</td>
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
                                    <td>
                                    <form action="{{url('dashboard/tasks/manage')}}" method="POST">@csrf
                                    <input type="hidden" name="task_id" value="{{$task['id']}}">
                                    @if ($task['status'] == 'completed')
                                    <a type="button" class="btn btn-sm btn-success disabled" title="اتمام"><i class="bi bi-check icon-size"></i></a>
                                    <a type="button" class="btn btn-sm btn-danger disabled" title="لغو"><i class="bi bi-x-lg icon-size"></i></a>
                                    @elseif ($task['status'] == 'cancel')
                                    <a type="button" class="btn btn-sm btn-success disabled" title="اتمام"><i class="bi bi-check icon-size"></i></a>
                                    <a type="button" class="btn btn-sm btn-danger disabled" title="لغو"><i class="bi bi-x-lg icon-size"></i></a>
                                    @else
                                    <button type="submit" class="btn btn-sm btn-success" title="اتمام" name="btn" value="completed"><i class="bi bi-check icon-size"></i></button>
                                    <button type="submit" class="btn btn-sm btn-danger" title="لغو"  name="btn" value="cancel"><i class="bi bi-x-lg icon-size"></i></button>
                                    @endif
                                    <button type="submit" class="btn btn-sm btn-warning" title="حذف وظیفه" name="btn" value="delete"><i class="bi bi-trash icon-size"></i></button>
                                    @if (!empty($task['photo']))
                                    <a target="_blank" href="{{url('images/tasks/'.$task['photo'])}}" class="btn btn-sm btn-info"
                                    title="دانلود تصویر"><i class="bi bi-file-earmark-arrow-down-fill icon-size"></i></a>
                                    @else
                                    <button type="submit" disabled class="btn btn-sm btn-info" name="btn" value="download"><i class="bi bi-file-earmark-arrow-down-fill icon-size"></i></button>
                                    @endif
                                    </form>
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
                        لیست کل وظایف
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple2">
                            <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>نوع</th>
                                    <th>تاریخ انجام</th>
                                    <th>وضعیت</th>
                                    <th>اقدام</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>نوع</th>
                                    <th>تاریخ انجام</th>
                                    <th>وضعیت</th>
                                    <th>اقدام</th>
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
                                    <td>
                                    <form action="{{url('dashboard/tasks/manage')}}" method="POST">@csrf
                                    <input type="hidden" name="task_id" value="{{$task['id']}}">
                                    @if ($task['status'] == 'completed')
                                    <a type="button" class="btn btn-sm btn-success disabled" title="اتمام"><i class="bi bi-check icon-size"></i></a>
                                    <a type="button" class="btn btn-sm btn-danger disabled" title="لغو"><i class="bi bi-x-lg icon-size"></i></a>
                                    @elseif ($task['status'] == 'cancel')
                                    <a type="button" class="btn btn-sm btn-success disabled" title="اتمام"><i class="bi bi-check icon-size"></i></a>
                                    <a type="button" class="btn btn-sm btn-danger disabled" title="لغو"><i class="bi bi-x-lg icon-size"></i></a>
                                    @else
                                    <button type="submit" class="btn btn-sm btn-success" title="اتمام" name="btn" value="completed"><i class="bi bi-check icon-size"></i></button>
                                    <button type="submit" class="btn btn-sm btn-danger" title="لغو"  name="btn" value="cancel"><i class="bi bi-x-lg icon-size"></i></button>
                                    @endif
                                    <button type="submit" class="btn btn-sm btn-warning" title="حذف وظیفه" name="btn" value="delete"><i class="bi bi-trash icon-size"></i></button>
                                    @if (!empty($task['photo']))
                                    <a target="_blank" href="{{url('images/tasks/'.$task['photo'])}}" class="btn btn-sm btn-info"
                                    title="دانلود تصویر"><i class="bi bi-file-earmark-arrow-down-fill icon-size"></i></a>
                                    @else
                                    <button type="submit" disabled class="btn btn-sm btn-info" name="btn" value="download"><i class="bi bi-file-earmark-arrow-down-fill icon-size"></i></button>
                                    @endif
                                    </form>
                                    </td>
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
