@extends('user.layout.app')

@section('main')
    <div class="movie_hot bg-black mt-4">
        <div class="movie_search rounded-2 mt-2 ">
            <a class="movie_search__link text-capitalize text-white text-decoration-none " href="./index.html">Trang chủ
                /</a>
            <a class="movie_search__link text-capitalize text-white text-decoration-none " href="./index.html">Tìm kiếm/
            </a>
            <a class="movie_search__link active text-capitalize text-decoration-none "
                href="./timkiem.html">{{ $movie_search_link->name }}</a>
        </div>

        <!-- Movie hot -->
        <div class="bg-black ">
            <div class="row">
                <div class="col-2 my-3">
                    <a href="{{ route('detail', ['slug' => $movie_search_link->slug]) }}"
                        class="text-decoration-none text-white movie_hot__link">
                        <div class="position-relative">
                            <img class="movie_hot__img w-100 d-block rounded  " src="{{ $movie_search_link->thumb_url }}"
                                alt="">
                            <div class="movie_hot__episode">
                                <div class="movie_hot__episode">
                                    @if ($movie_search_link->quality == 1)
                                        <span class="movie_hot__episode-text">HD -
                                            {{ $movie_search_link->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                    @elseif($movie_search_link->quality == 0)
                                        <span class="movie_hot__episode-text">FullHD -
                                            {{ $movie_search_link->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="movie_hot__name">
                            <p class="movie_hot__title-name">{{ $movie_search_link->name }}</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
        <!-- emd Movie hot -->

    </div>
@endsection
