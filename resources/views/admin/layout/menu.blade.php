    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
            <a class="navbar-brand brand-logo" href="{{ route('admin') }}">
                {{-- <img src="images/logo.svg" alt="logo" class="logo-dark" /> --}}
                <h2 class="card-header text-primary ">Admin CP</h2>
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('admin') }}"><img src="images/logo-mini.svg"
                    alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
            <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Chào mừng bảng điều khiển !</h5>
            <ul class="navbar-nav navbar-nav-right ml-auto">
                <form class="search-form d-none d-md-block" action="#">
                    <i class="icon-magnifier"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
                <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                        aria-expanded="false">
                        @if (Auth::check())
                            {{-- <img class="img-xs rounded-circle ml-2" src="https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/292011549_1192119298221484_5096720056686154923_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFfvGbLLkXpkhh4_AgGJ9KToO6Wq5TewTyg7parlN7BPCu6wW3kiNaglFWrRn8OpMrGULICPaEcVvgpxUWvv0gn&_nc_ohc=auvuDrYJm2MQ7kNvgGAolrR&_nc_ht=scontent.fhan2-5.fna&oh=00_AYDgiMUWa3cPHWzXJ47seM9yEBCtvIw42coUJxC9gaciQg&oe=668ED914"
                                alt="Profile image"> --}}
                            <img class="img-xs rounded-circle ml-2" src="{{ Auth::user()->avatar }}"
                                alt="Profile image">
                            <span class="font-weight-normal"> {{ Auth::user()->name }} </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            @if (Auth::check())
                                <img class="img-md rounded-circle" src="{{ Auth::user()->avatar }}" alt="Profile image">
                                {{-- <img width="50px" class="img-md rounded-circle" src="https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/292011549_1192119298221484_5096720056686154923_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFfvGbLLkXpkhh4_AgGJ9KToO6Wq5TewTyg7parlN7BPCu6wW3kiNaglFWrRn8OpMrGULICPaEcVvgpxUWvv0gn&_nc_ohc=auvuDrYJm2MQ7kNvgGAolrR&_nc_ht=scontent.fhan2-5.fna&oh=00_AYDgiMUWa3cPHWzXJ47seM9yEBCtvIw42coUJxC9gaciQg&oe=668ED914" alt="Profile image"> --}}
                                <p class="mb-1 mt-3">{{ Auth::user()->name }}</p>
                                <p class="font-weight-light text-muted mb-0">{{ auth()->user()->email }}</p>
                            @endif
                        </div>
                        <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> Hồ sơ cá
                            nhân </span></a>
                     
                        <a href="{{ route('/') }}" class="dropdown-item"><i
                                class="dropdown-item-icon icon-energy text-primary"></i>
                            Chuyển trang web người dùng</a>
                        {{-- <a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i>
                            Câu hỏi</a> --}}
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Đăng
                                xuất</button>
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
