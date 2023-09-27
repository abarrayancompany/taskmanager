@extends('layouts.app')
@section('content')
        <div class="container-fluid px-4">
            <h1 class="mt-4">لیست وظایف</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">داشبورد</a></li>
                <li class="breadcrumb-item active">کاربران</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    شما در این قسمت می‌توانید اخرین کاربران  را مشاهده و مدیریت کنید
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
                                <th>شناسه</th>
                                <th>نام کاربر</th>
                                <th>شماره دانشجویی</th>
                                <th>ایمیل</th>
                                <th>تاریخ ایجاد</th>
                                <th>اقدام</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>شناسه</th>
                                <th>نام کاربر</th>
                                <th>شماره دانشجویی</th>
                                <th>ایمیل</th>
                                <th>تاریخ ایجاد</th>
                                <th>اقدام</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user )
                            <tr>
                                <td>{{$user['id']}}</td>
                                <td>{{$user['name']}}</td>
                                <td>{{$user['student_code']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>@php $date = new Verta ($user['created_at']); @endphp {{$date}} </td>
                                <td>
                                    <form action="{{url('admin/dashboard/user/delete')}}" method="POST">@csrf
                                    <input type="hidden" name="user_id" value="{{$user['id']}}">
                                    <button type="submit" class="btn btn-sm btn-danger" title="حذف"  name="btn" value="delete"><i class="bi bi-x-lg icon-size"></i></button>
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
