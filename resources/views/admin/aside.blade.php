<style>
    .orders::after {
        display: none !important
    }
</style>

<div class="sidebar" data-color="danger" data-background-color="white" data-image="{{ asset('/') }}/assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="{{ url("/") }}" class="simple-text text-danger logo-normal">
            تطبيق ترحيل
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ request()->segment(1) == '' ? 'active' : '' }}  ">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="material-icons">dashboard</i>
                    <p>لوحة التحكم</p>
                </a>
            </li>
            @permission('orders-read')
                <li class="nav-item {{ request()->segment(1) == 'orders' ? 'active' : '' }}  dropdown">
                    <a class="nav-link dropdown-toggle orders" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">content_paste</i>
                        <p>الطلبات</p>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('orders.index') }}?status=new">الجديدة</a>
                        <a class="dropdown-item" href="{{ route('orders.index') }}?status=accepted">الموافق عليها</a>
                        <a class="dropdown-item" href="{{ route('orders.index') }}?status=run">الجارية</a>
                        <a class="dropdown-item" href="{{ route('orders.index') }}?status=done">المكتملة</a>
                    </div>
                </li>
            @endpermission
            @permission('companies-read')
            <li class="nav-item {{ request()->segment(1) == 'companies' ? 'active' : '' }}  ">
                <a class="nav-link" href="{{ route('companies.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>الشركات</p>
                </a>
            </li>
            @endpermission
            @permission('units-read')
            <li class="nav-item {{ request()->segment(1) == 'units' ? 'active' : '' }}  ">
                <a class="nav-link" href="{{ route('units.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>الوحدات</p>
                </a>
            </li>
            @endpermission
            @permission('pricings-read')
            <li class="nav-item {{ request()->segment(1) == 'pricings' ? 'active' : '' }}  ">
                <a class="nav-link" href="{{ route('pricings.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>الاسعار</p>
                </a>
            </li>
            @endpermission
            @permission('users-read')
            <li class="nav-item {{ request()->segment(1) == 'users' ? 'active' : '' }}  ">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>المستخدمين</p>
                </a>
            </li>
            @endpermission
        </ul>
    </div>
</div>
