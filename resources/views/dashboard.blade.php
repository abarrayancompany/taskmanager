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
                    <div class="card-body">10 وظیفه ایجاد شده</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">مشاهده لیست</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">3 وظیفه نزدیک</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">مشاهده لیست</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">2 وظیفه موفق</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">مشاهده لیست</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">4 وظیفه انجام نشده</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">مشاهده لیست</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
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
                            <th>گروه</th>
                            <th>نوع</th>
                            <th>زمان ایجاد</th>
                            <th>تاریخ وظیفه</th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>عنوان</th>
                            <th>گروه</th>
                            <th>نوع</th>
                            <th>زمان ایجاد</th>
                            <th>تاریخ وظیفه</th>
                            <th>وضعیت</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>وظیفه شماره 1</td>
                            <td>طراحی</td>
                            <td>پروژه</td>
                            <td>1402-05-05</td>
                            <td>1402/05/25</td>
                            <td>ایجاد شده</td>
                        </tr>
                        <tr>
                            <td>وظیفه شماره 1</td>
                            <td>طراحی</td>
                            <td>پروژه</td>
                            <td>1402-05-05</td>
                            <td>1402/05/25</td>
                            <td>ایجاد شده</td>
                        </tr>
                        <tr>
                            <td>وظیفه شماره 1</td>
                            <td>طراحی</td>
                            <td>پروژه</td>
                            <td>1402-05-05</td>
                            <td>1402/05/25</td>
                            <td>ایجاد شده</td>
                        </tr>
                        <tr>
                            <td>وظیفه شماره 1</td>
                            <td>طراحی</td>
                            <td>پروژه</td>
                            <td>1402-05-05</td>
                            <td>1402/05/25</td>
                            <td>ایجاد شده</td>
                        </tr>
                        <tr>
                            <td>وظیفه شماره 1</td>
                            <td>طراحی</td>
                            <td>پروژه</td>
                            <td>1402-05-05</td>
                            <td>1402/05/25</td>
                            <td>ایجاد شده</td>
                        </tr>
                        <tr>
                            <td>وظیفه شماره 1</td>
                            <td>طراحی</td>
                            <td>پروژه</td>
                            <td>1402-05-05</td>
                            <td>1402/05/25</td>
                            <td>ایجاد شده</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
