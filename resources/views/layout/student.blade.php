@extends('layout.default')

@section('content')

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Student Page</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="{{route('student.studentPayment')}}">
            <i class="fa-solid fa-money-bill"></i>
            <span>Payment Summary</span></a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="customer.php">
            <i class="fa-solid fa-bell"></i>
            <span>Notification</span></a>
        </li>

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
                            @yield('student-title')
                        </span>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Student</span>
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
