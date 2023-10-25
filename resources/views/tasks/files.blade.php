@extends('layouts.app')
@section('content')
        <div class="container-fluid px-4">
            <h1 class="mt-4">لیست فایل های وظیفه {{$task['title']}}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{url('tasks')}}">وظایف</a></li>
                <li class="breadcrumb-item active">فایل ها</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    شما در این قمت می‌توانید فایل های این وظیفه را مدیریت کنید
                </div>
            </div>
            @include('_alert')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    فایل های وظیفه {{$task['title']}}
                </div>
                <div class="card-body">
                    <form class="form form-horizontal" action="{{url('tasks/files/upload')}}" method="post"enctype="multipart/form-data"> @csrf
                        <div class="form-body">
                              <div class="row">
                                <div class="col-md-6">
                                    <h5>عنوان وظیفه : {{$task['title']}}</h5>
                                    <h5>تاریخ انجام : {{$task['due_date']}}</h5>
                                    <h5>وضعیت :
                                        @if ($task['status'] == 'in_progress' )
                                    <span class="badge bg-info text-dark">در حال انجام</span>
                                    @elseif ($task['status'] == 'pending' )
                                    <span class="badge bg-warning text-dark">در انتظار بررسی</span>
                                    @elseif ($task['status'] == 'completed' )
                                    <span class="badge bg-success">تکمیل شده</span>
                                    @elseif ($task['status'] == 'cancel' )
                                    <span class="badge bg-danger">لغو شده</span>
                                    @endif
                                    </h5>
                                </div>
                             <div class="col-md-6">
                                 <fieldset class="form-group">
                                     <label for="basicInputFile">بارگزاری فایل های جدید</label>
                                     <div class="form-floating mb-3">
                                        <input class="form-control" id="file[]" name="file[]" type="file" value="" multiple>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button type="submit" class="btn btn-primary">بارگزاری</button></div>
                                        </div>
                                    </div>
                                </fieldset>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="task_id" value="{{$task['id']}}">
                     </form>
                     <br>
                     <br>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th style="with:70%">تاریخ بارگزاری</th>
                                <th style="with:30%">اقدام</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="with:70%">تاریخ بارگزاری</th>
                                <th style="with:30%">اقدام</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($taskFiles as $file )
                            <tr>
                                <td>@php $date = new Verta ($task['created_at']); @endphp {{$date}} </td>
                                <td>
                                <a target="_blank" href="{{url('images/tasks/'.$file['file'])}}" class="btn btn-sm btn-info"
                                title="دانلود فایل"><i class="bi bi-file-earmark-arrow-down-fill icon-size"></i></a>
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
