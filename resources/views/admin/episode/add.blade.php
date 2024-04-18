@extends('admin.layout.app')
@section('title', 'Phim')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form thêm tập phim</h4>
                            <form action="{{ route('episode.store') }}" class="forms-sample needs-validation " method="post"
                                novalidate>
                                @csrf
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="select_movie">Chọn phim</label>
                                        <select class="form-control" name="id_movie" id="select_movie">
                                            @foreach ($list as $movie)
                                                <option {{ $id_movie == $movie->id ? 'selected' : '' }}
                                                    value="{{ $movie->id }}">{{ $movie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="link_phim">Link phim</label>
                                        <input type="text" class="form-control @error('link_movie') is-invalid @enderror"
                                            placeholder="Nhập dữ liệu ..." id="link_movie" name="link_movie"
                                            value="{{ old('link_phim') }}">
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
                                            <option selected disabled value="">--- Chọn tập ---</option>
                                            @foreach ($list as $item)
                                                @if ($id_movie == $item->id)
                                                    @for ($i = 1; $i <= $item->total_episodes; $i++)
                                                        <option {{ old('episode') == $i ? 'selected' : '' }}
                                                            value="{{ $i }}">
                                                            {{ $item->name }}
                                                            - Tập {{ $i }}
                                                        </option>
                                                    @endfor
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('episode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

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
