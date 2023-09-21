@extends('layouts.app')
@section('content')
        <div class="container-fluid px-4">
            <h1 class="mt-4">وظیفه جدید</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">داشبورد</a></li>
                <li class="breadcrumb-item"><a href="{{url('dashboard/tasks')}}">وظایف</a></li>
                <li class="breadcrumb-item active">وظیفه جدید</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    شما در این قسمت می‌توانید وظیفه جدید ایجاد کنید
                </div>
            </div>
            @include('_alert')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    ایجاد وظیفه
                </div>
                <div class="card-body">
                    <form action="{{url('dashboard/tasks/new')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="title" name="title" type="text" placeholder="عنوان وظیفه را وارد کنید" />
                                    <label for="inputFirstName">عنوان</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="type" id="type" placeholder="نوع وظیفه را انتخاب کنید">
                                        <option>نوع وظیفه را انتخاب کنید</option>
                                        @foreach ($types as $type)
                                            <option value="{{$type['id']}}">{{$type['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input data-jdp class="form-control" id="due_date" name="due_date" type="text" placeholder="تاریخ وظیفه را مشخص کنید" />
                                    <label for="inputFirstName">تاریخ انجام</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="status" id="status" placeholder="وضعیت را انتخاب کنید">
                                        <option>وضعیت وظیفه را انتخاب کنید</option>
                                            <option value="pending">در انتظار بررسی</option>
                                            <option value="in_progress">در حال انجام</option>
                                            <option value="completed">تکمیل شده</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="description" name="description" type="text" placeholder="توضیحات وظیفه را وارد کنید" />
                            <label for="inputLastName">توضیحات</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="task_image" name="task_image" type="file" value="">
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><button type="submit" class="btn btn-primary">ایجاد وظیفه</a></div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                jalaliDatepicker.startWatch();
                separatorChars(object);
            </script>
        </div>
@endsection
