@extends('admin.layout.app')
@section('title', 'Danh mục')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form thêm danh mục</h4>
                            <form action="{{ route('category.store') }}" class="forms-sample needs-validation" method="post"
                                novalidate>
                                @csrf
                                <div class="form-group">
                                    <label for="slug">Tên</label>
                                    <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug()"
                                        name="name" required id="slug" placeholder="Điền vào trỗ trống ...">
                                    <div class="invalid-feedback">
                                        Vui lòng điền vào chỗ trống !
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="convert_slug">Slug</label>
                                    <input type="text" placeholder="Điền vào trỗ trống ..." class="form-control"
                                        placeholder="Email" readonly id="convert_slug" name="slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender">Trạng thái</label>
                                    <select class="form-control" disabled id="exampleSelectGender">
                                        <option selected>Hiện</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                                <a href="{{ route('category.index') }}" class="btn btn-light">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
