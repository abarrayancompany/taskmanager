<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link @if (session::get('page')=="dashboard") active @endif" href="{{url('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                داشبورد
            </a>
            <a class="nav-link @if (session::get('page')=="tasks") active @endif" href="{{url('dashboard/tasks')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                وظایف
            </a>
            <a class="nav-link @if (session::get('page')=="new_task") active @endif" href="{{url('dashboard/tasks/new')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                ایجاد وظیفه جدید
            </a>
            <a class="nav-link @if (session::get('page')=="calendar") active @endif" href="{{url('dashboard/calendar')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                تقویم
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">فرشید اصلانی عزیز خوش‌آمدید</div>
        <a style="float:left; color:white;" href="{{url('logout')}}">خروج</a>
    </div>
</nav>
