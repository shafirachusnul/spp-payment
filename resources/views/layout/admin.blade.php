@extends('layout.default')

@section('content')

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            @if (auth()->user()->role == 'admin')
                <div class="sidebar-brand-text mx-3">Admin Page</div>
            @else
                <div class="sidebar-brand-text mx-3">Headmaster Page</div>
            @endif
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin.paymentList')}}">
            <i class="fa-solid fa-basket-shopping"></i>
            <span>Payment List</span></a>
        </li>

        <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.studentList')}}">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Student List</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin.insertPayment')}}">
            <i class="fa-solid fa-basket-shopping"></i>
            <span>Insert Payment</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin.insertStudent')}}">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Insert Student</span></a>
        </li>

        @if (auth()->user()->role == 'headmaster')
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.adminList')}}">
                <i class="fa-solid fa-user-tie"></i>
                <span>List Admin</span></a>
            </li>
        @endif

        @if (auth()->user()->role == 'headmaster')
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.insertAdmin')}}">
                <i class="fa-solid fa-user-tie"></i>
                <span>Insert Admin</span></a>
            </li>
        @endif

        <li class="nav-item active">
            <a class="nav-link" href="{{route('guest.handleLogout')}}">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span></a>
        </li>
    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <span class="navbar-brand mb-0 h1">
                            @yield('admin-title')
                        </span>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (auth()->user()->role == 'admin')
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                            @else
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Headmaster</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="container-fluid">

                @yield('inner-content')

            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright SppPayment &copy;</span>
                </div>
            </div>
        </footer>

    </div>
</div>

@endsection
