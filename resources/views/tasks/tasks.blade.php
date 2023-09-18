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
                                <th>نوع</th>
                                <th>تاریخ انجام</th>
                                <th>وضعیت</th>
                                <th>تاریخ ایجاد</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>نوع</th>
                                <th>تاریخ انجام</th>
                                <th>وضعیت</th>
                                <th>تاریخ ایجاد</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
