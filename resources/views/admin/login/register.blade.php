@extends('admin.layout.app')
@section('title', 'Đăng kí')
@section('user')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="{{ asset('images/logo.svg') }}">
                        </div>
                        <h4>Mới ở đây à?</h4>
                        <h6 class="font-weight-light">Đăng ký rất dễ dàng. Chỉ mất vài bước</h6>
                        <form action="{{ route('register') }}" method="POST" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="name"
                                    id="exampleInputUsername1" placeholder="Điền tên">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" name="email"
                                    id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" name="password"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions
                                    </label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                    type="submit">Đăng
                                    kí</button>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> Nếu bạn đã có tài khoản ? <a
                                    href="{{ route('login') }}" class="text-primary">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
@endsection
