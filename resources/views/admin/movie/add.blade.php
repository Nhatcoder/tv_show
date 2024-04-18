@extends('admin.layout.app')
@section('title', 'Phim')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form thêm phim</h4>
                            <form action="{{ route('movie.store') }}" class="forms-sample needs-validation " method="post"
                                novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="slug">Tên</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                onkeyup="ChangeToSlug()" name="name" id="slug"
                                                placeholder="Điền vào trỗ trống ..." value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="convert_slug">Slug</label>
                                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                                placeholder="..." id="convert_slug" name="slug"
                                                value="{{ old('slug') }}" readonly>
                                            @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="originame">Tên tiếng anh</label>
                                            <input type="text"
                                                class="form-control @error('original_name') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="originame" name="original_name"
                                                value="{{ old('original_name') }}">
                                            @error('original_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="time">Thời lượng</label>
                                            <input type="text" class="form-control @error('time') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="time" name="time"
                                                value="{{ old('time') }}">
                                            @error('time')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="total_episodes">Số tập phim</label>
                                            <input type="text"
                                                class="form-control @error('total_episodes') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="total_episodes"
                                                name="total_episodes" value="{{ old('total_episodes') }}">
                                            @error('total_episodes')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Hot</label>
                                            <select class="form-control" name="hot">
                                                <option value="0">Ẩn</option>
                                                <option value="1">Hiện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Hot slider</label>
                                            <select class="form-control" name="hot_slider">
                                                <option value="1">Hiện</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Điền vào trỗ trống ..."
                                        id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="thumb_url">Ảnh nhỏ</label>
                                            <input type="text"
                                                class="form-control @error('thumb_url') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="thumb_url" name="thumb_url"
                                                value="{{ old('thumb_url') }}">
                                            @error('thumb_url')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="poster_url">Ảnh to</label>
                                            <input type="text"
                                                class="form-control @error('poster_url') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="poster_url" name="poster_url"
                                                value="{{ old('poster_url') }}">
                                            @error('poster_url')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Danh mục</label>
                                            <select class="form-control" name="id_category">
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id_category }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="language">Phụ Đề</label>
                                            <select class="form-control" id="language" name="language">
                                                <option value="1">Vietsub</option>
                                                <option value="2">Thuyết Minh</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="quality">Chất lượng</label>
                                            <select class="form-control" id="quality" name="quality">
                                                <option value="1">HD</option>
                                                <option value="2">Full HD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span>Thể loại</span>
                                    <div class="d-flex  @error('genre') is-invalid @enderror">
                                        @foreach ($genre as $item)
                                            <div class="form-check form-check-flat form-check-info mr-2 mb-0">
                                                <label class="form-check-label mb-0">
                                                    <input type="checkbox" name="genre[]"
                                                        {{ is_array(old('genre')) && in_array($item->id, old('genre')) ? 'checked' : '' }}
                                                        value="{{ $item->id }}" class="form-check-input">
                                                    {{ $item->name }}
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('genre')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="director">Đạo diễn</label>
                                            <input type="text"
                                                class="form-control @error('director') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="director" name="director"
                                                value="{{ old('director') }}">
                                            @error('director')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="casts">Diễn viên</label>
                                            <input type="text"
                                                class="form-control @error('casts') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="casts" name="casts"
                                                value="{{ old('casts') }}">
                                            @error('casts')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleSelectGender">Trạng thái</label>
                                            <select class="form-control" disabled id="exampleSelectGender">
                                                <option selected>Hiện</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                                <a href="{{ route('movie.index') }}" class="btn btn-light">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
