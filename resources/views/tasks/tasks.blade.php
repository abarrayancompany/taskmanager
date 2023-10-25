@extends('layouts.app')
@section('content')
        <div class="container-fluid px-4">
            <h1 class="mt-4">لیست وظایف</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">داشبورد</a></li>
                <li class="breadcrumb-item active">وظایف</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    شما در این قسمت می‌توانید اخرین وظایف زمان بندی شده توسط خود را مشاهده و مدیریت کنید
                </div>
            </div>
            @include('_alert')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    وظایف
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>تاریخ انجام</th>
                                <th>وضعیت</th>
                                <th>تاریخ ایجاد</th>
                                <th>آخرین بروزرسانی</th>
                                <th>اقدام</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>تاریخ انجام</th>
                                <th>وضعیت</th>
                                <th>تاریخ ایجاد</th>
                                <th>آخرین بروزرسانی</th>
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
                                <td>{{$task['description']}}</td>
                                <td>
                                    @if (!empty($task['due_date']))
                                    {{$task['due_date']}}
                                    @else
                                    <span class="badge bg-danger">تاریخ تعین نشده است</span>
                                    @endif
                                </td>
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
                                <td>@php $date = new Verta ($task['created_at']); @endphp {{$date}} </td>
                                <td>@php $date = new Verta ($task['updated_at']); @endphp {{$date}} </td>
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
                                <a href="{{url('tasks/files/'.$task['id'])}}" class="btn btn-sm btn-info"
                                title="مشاهده فایل ها"><i class="bi bi-file-earmark-arrow-down-fill icon-size"></i></a>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
