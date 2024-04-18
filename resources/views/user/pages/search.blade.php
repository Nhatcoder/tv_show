@extends('user.layout.app')

@section('main')
    <div class="movie_hot bg-black mt-4">
        <div class="movie_search rounded-2 mt-2 ">
            <a class="movie_search__link text-capitalize text-white text-decoration-none " href="./index.html">Trang chủ
                /</a>
            <a class="movie_search__link text-capitalize text-white text-decoration-none " href="./index.html">Tìm kiếm/
            </a>
            <a class="movie_search__link active text-capitalize text-decoration-none "
                href="./timkiem.html">{{ isset($_GET['search']) ? $_GET['search'] : '' }}</a>
        </div>


        <div class="bg-black ">
            <div class="row">
                @if (count($movie_search) > 0)
                    @foreach ($movie_search as $movie)
                        <div class="col-2 my-3">
                            <a href="{{ route('detail', ['slug' => $movie->slug]) }}"
                                class="text-decoration-none text-white movie_hot__link">
                                <div class="position-relative">
                                    <img class="movie_hot__img w-100 d-block rounded  " src="{{ $movie->thumb_url }}"
                                        alt="">
                                    <div class="movie_hot__episode">
                                        <div class="movie_hot__episode">
                                            @if ($movie->quality == 1)
                                                <span class="movie_hot__episode-text">HD -
                                                    {{ $movie->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                            @elseif($movie->quality == 0)
                                                <span class="movie_hot__episode-text">FullHD -
                                                    {{ $movie->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="movie_hot__name">
                                    <p class="movie_hot__title-name">{{ $movie->name }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="text-center my-5">
                        <h1 class="text-white text-center my-3">Không tìm thấy kết quả:
                            <b>{{ isset($_GET['search']) ? $_GET['search'] : '' }}</b>
                        </h1>
                        <img src="{{ asset('images/images/key_search.jpg') }}" alt=""
                            class="d-block mx-auto">
                    </div>
                @endif
            </div>
        </div>
        <!-- emd Movie hot -->

    </div>
@endsection
