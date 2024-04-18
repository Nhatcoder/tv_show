@extends('user.layout.app')

@section('user')
    <img class="d-block w-100 object-fit-cover h-100 " height="695px" src="{{ asset('images/') }}/images/login.png"
        alt="">

    <div class="position-fixed top-0 end-0 ">
        <a href="{{ route('/') }}"><img src="{{ asset('images/') }}/images/logo.png" alt="logo"
                class="header_logo_img"></a>
    </div>

    <div class="form_register p-4 ">
        <h2 class="fs-4 lh-base text-start fw-bold">Đăng nhập Movie để tận hưởng kho Phim, Show, Thể
            thao,
            Truyền hình cực
            đỉnh</h2>
        <form action="{{ route('login') }}" method="POST" class="text-start mt-5 ">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input type="text" class="form-control form-input-login" name="email" placeholder="Nhập email"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('email')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control form-input-login" name="password" placeholder="Nhập mật khẩu"
                    id="exampleInputPassword1">
                @error('password')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <button type="submit" class="w-100 btn btn-success  border-radius-0">Đăng nhập</button>
            </div>

            <div class="col text-center mt-4">
                <a href="./quenmatkhau.html" class="text-primary text-decoration-none ">Quên mật khẩu ?</a>
            </div>

            <div class="d-flex justify-content-between mt-5 ">
                <a href="" class="btn_login_face text-decoration-none">
                    <img src="{{ asset('images/') }}/images/icon_fb.jpg" alt="">
                    <span>Đăng nhập bằng Facebook</span>
                </a>
                <a href="{{ route('login-by-google') }}" class="btn_login_gg text-decoration-none">
                    <img src="{{ asset('images/') }}/images/icon_gg.jpg" alt="">
                    <span>Đăng nhập bằng Google</span>
                </a>
            </div>

            <div class="text-center mt-4 mb-4 ">
                <p>Nếu bạn chưa có tài khoản bạn có thể <a class="text-info px-1 text-decoration-none "
                        href="{{ route('register') }}">Đăng ký ?</a>
                </p>
            </div>
        </form>
    </div>
@endsection
