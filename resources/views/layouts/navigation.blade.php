@if(Auth::guard('admin')->check())
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link @if (session::get('page')=="dashboard") active @endif" href="{{url('admin/dashboard')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-speedometer"></i></div>
                داشبورد
            </a>
            <a class="nav-link @if (session::get('page')=="tasks") active @endif" href="{{url('admin/dashboard/tasks')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-list-task"></i></div>
                وظایف
            </a>
            <a class="nav-link @if (session::get('page')=="users") active @endif" href="{{url('admin/dashboard/users')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-people-fill"></i></div>
                مدیریت کاربران
            </a>
            <a class="nav-link @if (session::get('page')=="new_user") active @endif" href="{{url('admin/dashboard/user/new')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-person-plus-fill"></i></div>
                افزودن کاربر جدید
            </a>
            <a class="nav-link @if (session::get('page')=="admins") active @endif" href="{{url('admin/dashboard/admins')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-people"></i></div>
                مدیران سایت
            </a>
            <a class="nav-link @if (session::get('page')=="new_admin") active @endif" href="{{url('admin/dashboard/admin/new')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-person-plus-fill"></i></div>
                افزودن مدیر جدید
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">{{Auth::guard('admin')->user()->name}} عزیز خوش‌آمدید</div>
        <a style="float:left; color:white;" href="{{url('admin/logout')}}">خروج</a>
    </div>
</nav>
@elseif(Auth::guard('web')->check())
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link @if (session::get('page')=="dashboard") active @endif" href="{{url('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-speedometer"></i></div>
                داشبورد
            </a>
            <a class="nav-link @if (session::get('page')=="tasks") active @endif" href="{{url('dashboard/tasks')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-list-task"></i></div>
                وظایف
            </a>
            <a class="nav-link @if (session::get('page')=="new_task") active @endif" href="{{url('dashboard/tasks/new')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-plus-square-fill"></i></div>
                ایجاد وظیفه جدید
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">{{Auth::guard('web')->user()->name}} عزیز خوش‌آمدید</div>
        <a style="float:left; color:white;" href="{{url('logout')}}">خروج</a>

    </div>
</nav>
@endif
