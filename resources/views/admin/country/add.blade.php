@extends('admin.layout.app')
@section('title', 'Danh mục')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form thêm quốc gia</h4>
                            <form action="{{ route('country.store') }}" class="forms-sample needs-validation" method="post"
                                novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="slug">Tên</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="slug" onkeyup="ChangeToSlug()" name="name" required id="slug"
                                        placeholder="Điền vào trỗ trống ..." value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="convert_slug">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="Điền vào trỗ trống ..." readonly id="convert_slug" name="slug"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender">Trạng thái</label>
                                    <select class="form-control" disabled id="exampleSelectGender">
                                        <option selected>Hiện</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                                <a href="{{ route('country.index') }}" class="btn btn-light">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
