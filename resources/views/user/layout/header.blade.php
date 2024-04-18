 <div class="row position-fixed top-0 z-3 w-100 mx-auto ">
     <header class="header bg-black text-white px-5" style="border-bottom : 1px solid rgb(48, 52, 61);">
         <div class="header_left d-flex ">
             <div class="header_logo">
                 <a href="{{ route('/') }}"><img src="{{ asset('images/') }}/images/logo.png" alt="logo"
                         class="header_logo_img "></a>
             </div>

             <div class="header_menu">
                 <ul class="header_menu__list d-flex ">
                     <li class="header_menu__list-item">
                         <a href="{{ route('/') }}" class="header_menu__list-item--link active">Đề xuất</a>
                     </li>
                     @foreach ($category as $item)
                         <li class="header_menu__list-item">
                             <a href="{{ route('category', ['slug' => $item->slug]) }}"
                                 class="header_menu__list-item--link">{{ $item->name }}</a>
                         </li>
                     @endforeach
                 </ul>
             </div>
         </div>


         <div class="header_right ">
             {{-- <div class="header_search">
                 <form action="./timkiem.html" method="post">
                     <div class="header_search__form ">
                         <input type="text" placeholder="Nhập tên phim" class="header_search__form-input">
                         <a href="./timkiem.html" class="header_search__form-icon text-white ">
                             <i class="fa-solid fa-magnifying-glass header_search__form-icon_link"></i>
                         </a>
                     </div>
                 </form>
             </div> --}}
             <div class="header_search">
                 <form action="{{ route('search') }}" method="get">
                     <div class="header_search__form position-relative">
                         <input type="text" name="search" data-url="{{ route('/') }}" id="search" autocomplete="off"
                             value="{{ $movie_search_link->name ?? ($_GET['search'] ?? '') }}"
                             placeholder="Nhập tên phim" class="header_search__form-input">
                         <button type="submit" class="header_search__form-icon text-white ">
                             <i class="fa-solid fa-magnifying-glass header_search__form-icon_link"></i>
                         </button>
                         <ul class="header_search__list" id="header_search__list">
                             {{-- <li>
                                 <a href="#" class="header_search__list-link">okok</a>
                             </li>
                            --}}
                         </ul>
                     </div>

                 </form>
             </div>
             <a class="header_item text-decoration-none text-white">
                 <div class="header_item__icon">
                     <i class="fa-regular fa-clock"></i>
                 </div>
                 <div class="header_item__title">
                     <p class="pt-1">Lịch sử</p>
                 </div>
             </a>
             <a href="#" class="header_item text-decoration-none text-white">
                 <div class="header_item__icon">
                     <i class="fa-solid fa-globe"></i>
                 </div>
                 <div class="header_item__title">
                     <p class="pt-1">Ngôn ngữ</p>
                 </div>
             </a>

             @if (Auth::check())
                 <a href="{{ route('profile') }}" class="header_item text-decoration-none text-white">
                     <div class="header_item__icon">
                         <i class="fa-solid fa-user"></i>
                     </div>
                     <div class="header_item__title">
                         <p class="pt-1">{{ Auth::user()->name }}</p>
                     </div>
                 </a>
             @else
                 <a href="{{ route('login') }}" class="header_item text-decoration-none text-white">
                     <div class="header_item__icon">
                         <i class="fa-solid fa-user"></i>
                     </div>
                     <div class="header_item__title">
                         <p class="pt-1">Đăng nhập</p>
                     </div>
                 </a>
             @endif


         </div>
     </header>
 </div>
