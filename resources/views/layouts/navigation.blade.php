@if (Auth::guard('admin'))
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link @if (session::get('page')=="dashboard") active @endif" href="{{url('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-speedometer"></i></div>
                داشبورد
            </a>
            <a class="nav-link @if (session::get('page')=="tasks") active @endif" href="{{url('admin/dashboard/tasks')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-list-task"></i></div>
                وظایف
            </a>
            <a class="nav-link @if (session::get('page')=="users") active @endif" href="{{url('admin/dashboard/users')}}">
                <div class="sb-nav-link-icon"><i class="bi bi-plus-square-fill"></i></div>
                مدیریت کاربران
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">فرشید اصلانی عزیز خوش‌آمدید</div>
        <a style="float:left; color:white;" href="{{url('logout')}}">خروج</a>
    </div>
</nav>
@else
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
        <div class="small">فرشید اصلانی عزیز خوش‌آمدید</div>
        <a style="float:left; color:white;" href="{{url('logout')}}">خروج</a>
    </div>
</nav>
@endif
