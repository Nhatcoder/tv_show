@extends('admin.layout.app')
@section('title', 'Danh mục')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form cập nhật thể loại</h4>
                            <form action="{{ route('country.update', ['country' => $country->id]) }}"
                                class="forms-sample needs-validation" method="post" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="slug_edit">Tên</label>
                                    <input type="text" required class="form-control @error('name') is-invalid @enderror"
                                        onkeyup = "ChangeToSlug()"
                                        value="{{ isset($country->name) ? $country->name : old('name') }}" name="name"
                                        id="slug" placeholder="Điền vào trỗ trống ...">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="convert_slug_edit">Slug</label>
                                    <input type="text" placeholder="Điền vào trỗ trống ..." readonly
                                        class="form-control @error('slug') is-invalid @enderror" id="convert_slug"
                                        placeholder="slug" value="{{ isset($country->slug) ? $country->slug : old('slug') }}"
                                        name="slug">
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectGender">Trạng thái</label>
                                    <select class="form-control" name="status" id="exampleSelectGender">
                                        @if ($country->status == 1)
                                            <option selected value="1">Hiện</option>
                                            <option value="0">Ẩn</option>
                                        @else
                                            <option value="0" selected>Ẩn</option>
                                            <option value="1">Hiện</option>
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                                <a href="{{ route('country.index') }}" class="btn btn-light">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
