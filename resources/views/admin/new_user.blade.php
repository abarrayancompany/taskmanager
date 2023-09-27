@extends('layouts.app')
@section('content')
        <div class="container-fluid px-4">
            <h1 class="mt-4">وظیفه جدید</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard/tasks')}}">مدیریت کاربران</a></li>
                <li class="breadcrumb-item active">کاربر جدید</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    شما در این قسمت می‌توانید کاربر جدید ایجاد کنید
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    ایجاد کاربر
                </div>
                <div class="card-body">
                    <form action="{{url('admin/dashboard/user/new')}}" method="POST" enctype="multipart/form-data">@csrf
                        @include('_alert')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="name" name="name" type="text" placeholder="نام کاربر را وارد کنید" />
                                    <label for="name">نام کاربر</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="student_code" name="student_code" type="text" placeholder="شماره دانشجویی کاربر" />
                                    <label for="student_code">شماره دانشجویی کاربر</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="email" name="email" type="email" placeholder="ایمیل کاربر" />
                                    <label for="email">ایمیل کاربر</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="user_password" name="user_password" type="password" placeholder="رمز عبور" />
                                    <label for="user_password">رمز عبور حساب کاربری</label>
                                    <input class="mypassFunction" type="checkbox">نمایش رمز عبور
                                      <a class="btn btn-primary btn-sm text-white generatePassword" style="float:left">تولید رمز عبور</a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><button type="submit" class="btn btn-primary">ایجاد کاربر</a></div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
            $(document).on("click",".mypassFunction", function(){
                var x = document.getElementById("user_password");
                if (x.type == "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            });

            //Generate Password
            $(document).on("click",".generatePassword", function(){
                var password = Math.random().toString(36).substr(2, 10);
                document.getElementById('user_password').value = password;
            });
            </script>
        </div>
@endsection
