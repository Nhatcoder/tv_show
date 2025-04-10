   <nav class="sidebar sidebar-offcanvas position-fixed d-block" id="sidebar">
       <ul class="nav">
           <li class="nav-item nav-profile">
               <a href="#" class="nav-link">
                   <div class="profile-image">
                       @if (Auth::check())
                           <img class="img-xs rounded-circle" src="{{ Auth::user()->avatar }}" alt="profile image">
                           {{-- <img class="img-xs rounded-circle" src="https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/292011549_1192119298221484_5096720056686154923_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeFfvGbLLkXpkhh4_AgGJ9KToO6Wq5TewTyg7parlN7BPCu6wW3kiNaglFWrRn8OpMrGULICPaEcVvgpxUWvv0gn&_nc_ohc=auvuDrYJm2MQ7kNvgGAolrR&_nc_ht=scontent.fhan2-5.fna&oh=00_AYDgiMUWa3cPHWzXJ47seM9yEBCtvIw42coUJxC9gaciQg&oe=668ED914" alt="profile image"> --}}
                       @endif
                       <div class="dot-indicator bg-success"></div>
                   </div>
                   <div class="text-wrapper">
                       @if (Auth::check())
                           <p class="profile-name">
                               {{ strlen(Auth::user()->name) > 18 ? substr(Auth::user()->name, 0, 18) . '...' : Auth::user()->name }}
                           </p>
                       @endif
                       <p class="designation">Quản trị viên</p>
                   </div>
                   {{-- <div class="icon-container">
                       <i class="icon-bubbles"></i>
                       <div class="dot-indicator bg-danger"></div>
                   </div> --}}
               </a>
           </li>
           <li class="nav-item nav-category">
               <span class="nav-link">Thống kê</span>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="{{ route('admin') }}">
                   <span class="menu-title">Thống kê</span>
                   <i class="icon-screen-desktop menu-icon"></i>
               </a>
           </li>
           <li class="nav-item nav-category "><span class="nav-link">Menu</span></li>
           <li class="nav-item {{ request()->is('category*') ? 'active' : '' }}">
               <a class="nav-link " href="{{ route('category.index') }}">
                   <span class="menu-title">Danh mục</span>
                   <i class="icon-menu menu-icon"></i>
               </a>

           </li>
           <li class="nav-item {{ request()->is('genre*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ route('genre.index') }}">
                   <span class="menu-title">Thể loại</span>
                   <i class="icon-grid menu-icon"></i>
               </a>
           </li>
           <li class="nav-item {{ request()->is('country*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ route('country.index') }}">
                   <span class="menu-title">Quốc Gia</span>
                   <i class="icon-globe menu-icon"></i>
               </a>
           </li>
           <li class="nav-item {{ request()->is('movie*') ? 'active' : '' }}">
               <a class="nav-link" href="{{ route('movie.index') }}">
                   <span class="menu-title">Phim</span>
                   <i class=" icon-film menu-icon"></i>
               </a>
           </li>
           <li class="nav-item">
               <a class="nav-link {{ request()->is('episode*') ? 'active' : '' }}"
                   href="{{ route('episode.index') }}">
                   <span class="menu-title">Tập phim</span>
                   <i class="icon-layers menu-icon"></i>
               </a>
           </li>
           <li class="nav-item nav-category"><span class="nav-link">Quản lý user</span></li>
           <li class="nav-item">
               <a class="nav-link" href="{{ route('user-manager') }}">
                   <span class="menu-title">Quản lý user</span>
                   <i class="icon-user menu-icon"></i>
               </a>
           </li>
       </ul>
   </nav>
