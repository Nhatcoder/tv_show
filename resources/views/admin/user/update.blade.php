@extends('admin.layout.app')
@section('title', 'Danh mục')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cập nhật người dùng</h4>
                            <form action="{{ route('user-put', ['id' => $user->id]) }}" class="forms-sample needs-validation"
                                method="post" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="slug_edit">Tên</label>
                                    <input type="text" required class="form-control @error('name') is-invalid @enderror"
                                        value="{{ isset($user->name) ? $user->name : old('name') }}" name="name"
                                        id="slug" placeholder="Điền vào trỗ trống ...">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" placeholder="Điền vào trỗ trống ..."
                                        class="form-control @error('email') is-invalid @enderror" placeholder="email"
                                        value="{{ isset($user->email) ? $user->email : old('email') }}" name="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectGender">Quyền</label>
                                    <select class="form-control" name="role" id="exampleSelectGender">
                                        @if ($user->role == 1)
                                            <option selected value="1">Admin</option>
                                            <option value="0">User</option>
                                        @else
                                            <option value="1">Admin</option>
                                            <option value="0" selected>User</option>
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                                <a href="{{ route('user-manager') }}" class="btn btn-light">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
