<nav class="navbar navbar-expand topbar mb-4 static-top shadow nav-user">
    <a class="navbar-brand d-none d-sm-block" href="#">
        <img src="uploads/global_white_horizontal.webp" alt="" style="width:225px; height:43px;">
    </a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ url('/home') }}"
                class="nav-link navuser-link {{ Request::url() == url('/home') ? 'active_link' : '' }}"
                title="Dashboard"><span style="font-size:13px;" class="ml-1">Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a href="{{ url('/products') }}"
                class="nav-link navuser-link {{ Request::url() == url('/products') ? 'active_link' : '' }}"
                title="Inventory"><span style="font-size:13px;" class="ml-1">Inventory</span></a>
        </li>

        <li class="nav-item">
            <a href="{{ url('/checkins') }}"
                class="nav-link navuser-link {{ Request::url() == url('/checkins') ? 'active_link' : '' }}"
                title="Check-ins"><span style="font-size:13px;" class="ml-1">Check-in</span></a>
        </li>

        <li class="nav-item dropdown no-arrow">
            <a href=""
                class="nav-link navuser-link dropdown-toggle {{ Request::url() == url('/checkouts') ? 'active_link' : '' }}{{ Request::url() == url('/returns') ? 'active_link' : '' }}{{ Request::url() == url('/borrowed-items') ? 'active_link' : '' }}{{ Request::url() == url('/purchase-returns') ? 'active_link' : '' }}"
                title="Checkouts" role="button" data-toggle="dropdown" aria-expanded="false"><span
                    style="font-size:13px;" class="ml-1">Checkout</span></a>
            <div class="dropdown-menu">
                <a class="dropdown-item disabled" href="#">Checkout Menu:</a>
                <a class="dropdown-item {{ Request::url() == url('/checkouts') ? 'active_link' : '' }}"
                    href="{{ url('/checkouts') }}">Delivery</a>
                <a class="dropdown-item {{ Request::url() == url('/returns') ? 'active_link' : '' }}"
                    href="{{ url('/returns') }}">Returned</a>
                <a class="dropdown-item {{ Request::url() == url('/borrowed-items') ? 'active_link' : '' }}"
                    href="{{ url('/borrowed-items') }}">Borrowed Item</a>
                <a class="dropdown-item {{ Request::url() == url('/purchase-returns') ? 'active_link' : '' }}"
                    href="{{ url('/purchase-returns') }}">Purchase Return</a>
            </div>
        </li>
    </ul>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span style="font-size:11px;"
                    class="mr-2 d-none d-lg-inline text-white text-uppercase">{{ Auth::user()->name }}</span></span>
                <img class="img-profile rounded-circle" src="uploads/global-white.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a type="button" href="{{ url('edit-password') }}" class="dropdown-item">
                    <i class="fa-solid fa-passport mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item"
                    href="{{ route('logout') }}"onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"data-toggle="modal"
                    data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
