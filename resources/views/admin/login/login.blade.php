@extends('admin.layout.app')
@section('title', 'Đăng nhập')
@section('user')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    @if (Session::has('error'))
                        <div class="alert alert-danger ">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="../../images/logo.svg">
                        </div>
                        <h4>Xin chào! Bắt đầu nào</h4>
                        <h6 class="font-weight-light">Đăng nhập để tiếp tục.</h6>
                        <form action="{{ route('admin-login') }}" method="POST" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                    placeholder="Username" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Đăng
                                    nhập</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> Giữ tôi đăng nhập </label>
                                </div>
                                <a href="#" class="auth-link text-black">Quên mật khẩu?</a>
                            </div>
                            {{-- <div class="text-center mt-4 font-weight-light"> Bạn chưa có tài khoản? <a href="{{ route('admin-register') }}"
                                    class="text-primary">Tạo mới</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
@endsection
