<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark justify-content-between">
    <!-- Navbar Brand-->
    <div class="logo">
        <a href="{{route('frontend.home')}}"><img class="logo-img" src="{{asset('assets/common/img/logo/logo.png')}}" alt=""></a>
    </div>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="javascript:void(0);"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." for="btnNavbarSearch">
            <button class="btn btn-danger" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <div class="d-none d-md-inline-block main-menu f-right">
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                    @if(Auth::user())
                        {{Auth::user()->name}}
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#passwordModal">Password Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('logout.perform') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
