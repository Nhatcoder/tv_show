@extends('admin.layout.app')
@section('title', 'Tập phim')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form cập nhật tập phim</h4>
                            <form action="{{ route('episode.update', ['episode' => $episode->id]) }}"
                                class="forms-sample needs-validation " method="post" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="select_movie">Chọn phim</label>
                                        <select class="form-control" name="id_movie" id="select_movie">
                                            <option value="{{ $episode->id_movie }}">{{ $episode->movie->name }}</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="link_phim">Link phim</label>
                                        <input type="text" class="form-control @error('link_movie') is-invalid @enderror"
                                            placeholder="Nhập dữ liệu ..." id="link_movie" name="link_movie"
                                            value="{{ isset($episode->link_movie) ? $episode->link_movie : old('link_phim') }}">
                                        @error('link_movie')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="episode">Chọn tập phim</label>
                                        <select class="form-control @error('episode') is-invalid @enderror" name="episode"
                                            id="episode">
                                            <option value="{{ $episode->id }}">
                                                {{ $episode->movie->name }}
                                                - Tập {{ $episode->episode }}
                                            </option>
                                        </select>
                                        @error('episode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                                <a href="{{ route('episode.index') }}" class="btn btn-light">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
