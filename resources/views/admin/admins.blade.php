@extends('layouts.app')
@section('content')
        <div class="container-fluid px-4">
            <h1 class="mt-4">لیست مدیران</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">داشبورد</a></li>
                <li class="breadcrumb-item active">مدیران</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    شما در این قسمت می‌توانید اخرین مدیران  را مشاهده و مدیریت کنید
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
                                <th>ایمیل</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت کاربر</th>
                                <th>اقدام</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>شناسه</th>
                                <th>نام کاربر</th>
                                <th>ایمیل</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت کاربر</th>
                                <th>اقدام</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($admins as $admin )
                            <tr>
                                <td>{{$admin['id']}}</td>
                                <td>{{$admin['name']}}</td>
                                <td>{{$admin['email']}}</td>
                                <td>@php $date = new Verta ($admin['created_at']); @endphp {{$date}} </td>
                                <td>
                                    @if ($admin['status'] == 1 )
                                    <span class="badge bg-success text-light">کاربر فعال است</span>
                                    @else
                                    <span class="badge bg-danger text-light">کاربر غیرفعال است</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{url('admin/dashboard/admin/manage')}}" method="POST">@csrf
                                    <input type="hidden" name="admin_id" value="{{$admin['id']}}">
                                    <button type="submit" class="btn btn-md btn-danger" title="حذف"  name="btn" value="delete"><i class="bi bi-x"></i></button>
                                    @if ($admin['status'] == 0)
                                    <button type="submit" class="btn btn-md btn-success" title="فعالسازی"  name="btn" value="status1"><i class="bi bi-person-fill-check"></i></button>
                                    @else
                                    <button type="submit" class="btn btn-md btn-danger" title="غیر‌فعالسازی"  name="btn" value="status0"><i class="bi bi-person-fill-slash"></i></button>
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
@endsection
