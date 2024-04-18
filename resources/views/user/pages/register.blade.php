@extends('user.layout.app')

@section('user')
    <img class="d-block w-100 object-fit-cover h-100 " height="695px" src="{{ asset('images/') }}/images/login.png"
        alt="">

    <div class="position-fixed top-0 end-0 ">
        <a href="./index.html"><img src="{{ asset('images/') }}/images/logo.png" alt="logo" class="header_logo_img"></a>
    </div>

    <div class="form_register p-4 ">
        <h2 class="fs-4 lh-base text-start fw-bold">Đăng kí Movie để tận hưởng kho Phim, Show, Thể
            thao,
            Truyền hình cực
            đỉnh</h2>
        <form class="text-start mt-5" action="{{ route('register') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="exampleInputname1" class="form-label">Tên </label>
                <input type="name" class="form-control form-input-login" placeholder="Nhập tên" name="name"
                    id="exampleInputname1"  value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input type="email" class="form-control form-input-login" placeholder="Nhập email" name="email"
                    id="exampleInputEmail1" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control form-input-login" placeholder="Nhập mật khẩu"
                    id="exampleInputPassword1" name="password">
                @error('password')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" class="form-control form-input-login" placeholder="Nhập lại mật khẩu"
                    id="exampleInputPassword1" name="check_password">
                @error('check_password')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <button type="submit" class="w-100 btn btn-success  border-radius-0">Đăng kí</button>
            </div>


            <div class="d-flex justify-content-between mt-5 ">
                <a href="" class="btn_login_face text-decoration-none">
                    <img src="{{ asset('images/') }}/images/icon_fb.jpg" alt="">
                    <span>Đăng nhập bằng Facebook</span>
                </a>
                <a href="" class="btn_login_gg text-decoration-none">
                    <img src="{{ asset('images/') }}/images/icon_gg.jpg" alt="">
                    <span>Đăng nhập bằng Google</span>
                </a>
            </div>

            <div class="text-center mt-4 mb-4 ">
                <p>Nếu bạn đã có tài khoản bạn có thể <a class="text-info px-1 text-decoration-none"
                        href="{{ route('login') }}">Đăng Nhập
                        ?</a>
                </p>
            </div>
        </form>
    </div>
@endsection
