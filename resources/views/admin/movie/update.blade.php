@extends('admin.layout.app')
@section('title', 'Phim')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form cập nhật phim</h4>
                            <form action="{{ route('movie.update', ['movie' => $movie->id]) }}"
                                class="forms-sample needs-validation" method="post" novalidate>
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="slug">Tên</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                onkeyup="ChangeToSlug()" name="name" required id="slug"
                                                placeholder="Điền vào trỗ trống ..."
                                                value="{{ isset($movie->name) ? $movie->name : old('name') }}">
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
                                                value="{{ isset($movie->slug) ? $movie->slug : old('slug') }}" readonly>
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
                                                value="{{ isset($movie->original_name) ? $movie->original_name : old('original_name') }}">
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
                                                value="{{ isset($movie->time) ? $movie->time : old('time') }}">
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
                                                name="total_episodes"
                                                value="{{ isset($movie->total_episodes) ? $movie->total_episodes : old('total_episodes') }}">
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
                                                @if ($movie->hot == 1)
                                                    <option selected value="1">Hiện</option>
                                                    <option value="0">Ẩn</option>
                                                @else
                                                    <option value="1">Hiện</option>
                                                    <option selected value="0">Ẩn</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Hot slider</label>
                                            <select class="form-control" name="hot_slider">
                                                @if ($movie->hot_slider == 1)
                                                    <option selected value="1">Hiện</option>
                                                    <option value="0">Ẩn</option>
                                                @else
                                                    <option value="1">Hiện</option>
                                                    <option selected value="0">Ẩn</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Điền vào trỗ trống ..."
                                        id="description" name="description" rows="4">{{ isset($movie->description) ? $movie->description : old('description') }}</textarea>
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
                                            <input oninput='document.getElementById("render_img").src = this.value'
                                                type="text" class="form-control @error('thumb_url') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="thumb_url" name="thumb_url"
                                                value="{{ isset($movie->thumb_url) ? $movie->thumb_url : old('description') }}">
                                            @error('thumb_url')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="w-100 mb-3">
                                            <img id="render_img" class="d-block w-100 " height=500px
                                                src="{{ $movie->thumb_url }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="poster_url">Ảnh to</label>
                                            <input type="text"
                                                oninput = "getElementById('render_img2').src = this.value"
                                                class="form-control @error('poster_url') is-invalid @enderror"
                                                placeholder="Điền vào trỗ trống ..." id="poster_url" name="poster_url"
                                                value="{{ isset($movie->poster_url) ? $movie->poster_url : old('poster_url') }}">
                                            @error('poster_url')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="w-100 mb-3">
                                            <img id="render_img2" class="d-block w-100 " height=500px
                                                src="{{ $movie->poster_url }}" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Danh mục</label>
                                            <select class="form-control" name="id_category">
                                                @foreach ($category as $item)
                                                    <option
                                                        {{ $movie->id_category == $item->id_category ? 'selected' : '' }}
                                                        value="{{ $item->id_category }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="language">Phụ Đề</label>
                                            <select class="form-control" id="language" name="language">
                                                @if ($movie->language == 1)
                                                    <option selected value="1">Vietsub</option>
                                                    <option value="2">Thuyết Minh</option>
                                                @else
                                                    <option value="1">Vietsub</option>
                                                    <option selected value="2">Thuyết Minh</option>
                                                @endif
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="quality">Chất lượng</label>
                                            <select class="form-control" id="quality" name="quality">
                                                @if ($movie->quality == 1)
                                                    <option selected value="1">HD</option>
                                                    <option value="2">Full HD</option>
                                                @else
                                                    <option value="1">HD</option>
                                                    <option selected value="2">Full HD</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span>Thể loại</span>
                                    <div class="d-flex  @error('genre') is-invalid @enderror">
                                        {{-- <input type="checkbox" name="genre[]" {{ (($item->id == $movie_genre->id_genre) ? 'checked' : "") && is_array(old('genre')) && in_array($item->id, old('genre')) ? 'checked' : '' }}
                                                        value="{{ $item->id }}" class="form-check-input"> --}}
                                        @foreach ($genre as $item)
                                            <div class="form-check form-check-flat form-check-info mr-2 mb-0">
                                                <label class="form-check-label mb-0">


                                                    <input type="checkbox" name="genre[]" <input type="checkbox"
                                                        name="genre[]"
                                                        {{ $movie_genre->contains('id_genre', $item->id) ? 'checked' : '' }}
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
                                                value="{{ isset($movie->director) ? $movie->director : old('director') }}">
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
                                                value="{{ isset($movie->casts) ? $movie->casts : old('casts') }}">
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
                                            <select class="form-control"  id="exampleSelectGender">
                                                @if ($movie->hot == 1)
                                                    <option selected value="1">Hiện</option>
                                                    <option value="2">Ẩn</option>
                                                @else
                                                    <option value="1">Hiện</option>
                                                    <option selected value="2">Ẩn</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                                <a href="{{ route('movie.index') }}" class="btn btn-light">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
