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
                         <a href="{{ route('/') }}"
                             class="header_menu__list-item--link {{ Request::is('/') ? 'active' : '' }}">Đề xuất</a>
                     </li>
                     @foreach ($category as $item)
                         <li class="header_menu__list-item">
                             <a href="{{ route('category', ['slug' => $item->slug]) }}"
                                 class="header_menu__list-item--link {{ request()->is('the-loai/' . $item->slug . '*') ? 'active' : '' }}">
                                 {{ $item->name }}
                             </a>

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
                         <input type="text" name="search" data-url="{{ route('/') }}" id="search"
                             autocomplete="off" value="{{ $movie_search_link->name ?? ($_GET['search'] ?? '') }}"
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
             <a href="#" class="header_item text-decoration-none text-white">
                 <div class="header_item__icon">
                     <i class="fa-solid fa-bell"></i>
                 </div>
                 <div class="header_item__title position-relative">
                     <p class="pt-1">Thông báo</p>


                 </div>

                 <ul class="list_notifycation">
                     <h6 class="text-left">Thông báo</h6>
                     <hr>
                     <li class="list_item_notifycation my-2">
                         <a href="#" class="text-decoration-none text-white d-block">
                             <div class="row">
                                 <div class="col-2 text-center">
                                     <div class="image_notifycation">
                                         <img src="{{ asset('images/') }}/images/user.png" alt="">
                                     </div>
                                 </div>

                                 <div class="col-9 py-2">
                                     <div class="info_notifycation ms-2">
                                         <p class="info_notifycation_title">Nguyễn Văn A đã:Pc gaming đã tải đ lên: 5
                                             ?
                                         </p>
                                         <p>15 phút trước </p>
                                     </div>
                                 </div>

                                 <div class="col-1 p-0">
                                     <button class="btn-notifycation">
                                         <i class="fa-solid fa-ellipsis-vertical"></i>
                                     </button>
                                 </div>
                             </div>

                         </a>
                     </li>


                 </ul>

                 <style>
                     .image_notifycation img {
                         width: 100%;
                         border-radius: 50%;
                         width: 60px;
                         height: 60px;


                     }

                     .list_notifycation {
                         display: none;
                         position: absolute;
                         top: 100%;
                         bottom: 0;
                         right: 123px;
                         height: 600px;
                         width: 600px;
                         background: #333;
                         border-radius: 5px;
                     }

                     .info_notifycation_title {
                         color: #fff;
                         font-size: 16px;
                         font-weight: 400;
                         margin-bottom: 5px;
                     }

                     .btn-notifycation {
                         cursor: pointer;
                         padding: 7px 13.5px;
                         margin-right: 2px;
                         border: 1px solid transparent;
                         border-radius: 50%;
                     }

                     .list_item_notifycation:hover {
                         background-color: red;
                     }
                 </style>



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
