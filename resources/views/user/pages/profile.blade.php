@extends('user.layout.app')

@section('main')
    <main>
        <div class="main_user px-5">
            <div class="row g-0">
                <div class="col-2 user_category__item">
                    <div class="position-relative">
                        <img class="w-100 d-block " height="100px" src="{{ asset('images/') }}/images/bg_user.jpg"
                            alt="">
                        <div class="user_category">
                            <img class="user_category__img" src="{{ Auth::user()->avatar }}" alt="">
                            <span class="user_category__name text-capitalize ">Trần văn nhật
                                nnnnnnnnnnnnnnnnnnnnnnnnnnnnn</span>
                        </div>
                        <div class="mask">
                        </div>
                    </div>

                    <div class="user_category__content px-3 mt-4 ">
                        <h2 class="user_category__content-title">Cài đặt cá nhân</h2>


                        <ul class="user_category__content-list">
                            <li class="user_category__content-list--item">
                                <a href="./lichsuxem.html" class="user_category__content-list--item_link">
                                    Lịch sử xem
                                </a>
                            </li>
                            <li class="user_category__content-list--item">
                                <a href="#" class="user_category__content-list--item_link">
                                    Bộ sưu tập
                                </a>
                            </li>
                            <li class="user_category__content-list--item">
                                <a href="#" class="user_category__content-list--item_link">
                                    Phim đặt trước
                                </a>
                            </li>
                            <li class="user_category__content-list--item">
                                <a href="#" class="user_category__content-list--item_link">
                                    Bản dịch phụ đề
                                </a>
                            </li>
                        </ul>

                        <h2 class="user_category__content-title"></h2>

                        <li class="user_category__content-list--item pt-2 ">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn user_category__content-list--item_link">
                                    Đăng xuất
                                </button>
                            </form>
                        </li>
                    </div>
                </div>

                <div class="col-10 px-5">
                    <div class="user_content">
                        <h1 class="text-center mt-4 text-white fw-bold fs-2">Cài đặt cá nhân</h1>
                        <div class="mt-3 py-3"><span class="user_content-title">Thông tin cá nhân</span></div>
                        <div class="user_info rounded-2">
                            <div class="user_info__list p-4  ">
                                <img class="user_info__list-img rounded-circle" src="{{ Auth::user()->avatar }}"
                                    alt="">
                                <div class="user_info__list-item px-4">
                                    <h3 class="text-capitalize ">Trần Văn Nhật PH 3 3 5 7 2 FPL HN</h3>
                                    <span class="user_info__list-item">Giới tính: <strong>Không được thiết
                                            lập</strong></span>
                                    <span class="user_info__list-item">Ngày sinh: <strong>2000-06-06</strong></span>
                                    <span class="user_info__list-item">ID: <strong>123456789</strong></span>
                                </div>
                            </div>
                            <div class="user_info__edit">
                                <a class="user_info__edit-link" href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Chỉnh sửa</a>
                            </div>
                        </div>

                        <div class="mt-5 py-3"><span class="user_content-title">Tài khoản và bảo mật</span></div>
                        <div class="user_private rounded-2 mb-5">
                            <ul class="user_private__list p-4 ">
                                <li class="user_private__list-item d-flex justify-content-between pb-4">
                                    <div class="">
                                        <span>Email
                                            <strong>Nhattvph33572@fpt.edu.vn</strong></span>
                                    </div>

                                    <div class="user_private__list-item--edit">
                                        <a href="">Kích hoạt</a>
                                    </div>
                                </li>
                                <li class="user_private__list-item d-flex justify-content-between py-4">
                                    <div class="">
                                        <span>Số điện thoại
                                            <strong>Không được thiết lập</strong></span>
                                    </div>

                                    <div class="user_private__list-item--edit">
                                        <a href="">Cài đặt</a>
                                    </div>
                                </li>
                                <li class="user_private__list-item d-flex justify-content-between py-4">
                                    <div class="">
                                        <span>Mật khẩu
                                            <strong>Không được thiết lập</strong></span>
                                    </div>

                                    <div class="user_private__list-item--edit">
                                        <a href="">Cài đặt</a>
                                    </div>
                                </li>
                                <li class="user_private__list-item d-flex justify-content-between pt-4">
                                    <div class="">
                                        <span>Xóa tài khoản
                                            <strong>Xóa tài khoản hiện tại</strong></span>
                                    </div>

                                    <div class="user_private__list-item--edit">
                                        <a href="">Xóa bỏ</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal chỉnh sửa -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật thông tin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên tài khoản</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Nhập tên" value="Trần Văn Nhật">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Giới tính</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">Chưa được thiết lập</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleInputPassword1" class="form-label">Ngày</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">01</option>
                                        <option value="1">02</option>
                                        <option value="2">03</option>
                                        <option value="2">04</option>
                                        <option value="2">05</option>
                                        <option value="2">06</option>
                                        <option selected value="2">07</option>
                                        <option value="2">08</option>
                                        <option value="2">09</option>
                                        <option value="2">10</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="exampleInputPassword1" class="form-label">Tháng</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">01</option>
                                        <option value="1">02</option>
                                        <option value="2">03</option>
                                        <option value="2">04</option>
                                        <option value="2">05</option>
                                        <option selected value="2">06</option>
                                        <option value="2">07</option>
                                        <option value="2">08</option>
                                        <option value="2">09</option>
                                        <option value="2">10</option>
                                        <option value="2">11</option>
                                        <option value="2">12</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="exampleInputPassword1" class="form-label">Năm</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">2001</option>
                                        <option value="1">2002</option>
                                        <option value="2">2003</option>
                                        <option selected value="2">2004</option>
                                        <option value="2">2005</option>
                                        <option value="2">2006</option>
                                        <option value="2">2007</option>
                                        <option value="2">2008</option>
                                        <option value="2">2009</option>
                                        <option value="2">2010</option>
                                        <option value="2">2011</option>
                                        <option value="2">2012</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row px-2">
                                <button type="submit" class="btn btn-success mt-3">Cập nhật</button>
                                <button type="submit" class="btn btn-outline-danger  mt-3">Hủy bỏ</button>
                            </div>
                        </form>

                    </div>
                    <!-- <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div> -->
                </div>
            </div>
        </div>


    </main>
@endsection
