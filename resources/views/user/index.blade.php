@extends('user.layout.app')

@section('main')
    <main>
        <!-- slider -->
        <div class="slider">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class=" carousel-indicators">
                    @foreach ($movie_slider as $key => $item)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}" aria-current="true"
                            aria-label="Slide {{ $key }}"></button>
                    @endforeach

                </div>
                <div class="carousel-inner">
                    @foreach ($movie_slider as $key => $movie)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="position-relative">
                                <img class="d-block w-100 " src="{{ $movie->poster_url }}" alt="bg" class="">
                                <div class="slider_main">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="slider_content">
                                                <h1 class="slider_content__text">{{ $movie->name }}</h1>
                                                <!-- <img class="slider_left__img" src="./images/title_slider4.webp" alt="bg" class=""> -->
                                                <div class="slider_content__item">
                                                    <div class="slider_content__top">
                                                        <span>Top Hay</span>
                                                        <span>Chỉ có trên TV SHOW</span>
                                                    </div>
                                                    <ul class="slider_content__list">
                                                        <li class="slider_content__list-item">
                                                            <i class="fa-solid fa-star"></i> <a href=""
                                                                class="slider_content__list-item--link start">9.5</a>
                                                        </li>
                                                        <li class="slider_content__list-item">
                                                            <a href=""
                                                                class="slider_content__list-item--link">2024</a>
                                                        </li>
                                                        <li class="slider_content__list-item">
                                                            <a href=""
                                                                class="slider_content__list-item--link">{{ $movie->time }}</a>
                                                        </li>
                                                        <li class="slider_content__list-item">
                                                            <a href="" class="slider_content__list-item--link">Trọn
                                                                bộ
                                                                {{ $movie->total_episodes }} tập</a>
                                                        </li>
                                                    </ul>

                                                    <div class="slider_genre">
                                                        <ul class="slider_genre__list">
                                                            @foreach ($movie->movie_genre as $item)
                                                                <li class="slider_genre-item">
                                                                    <a href=""
                                                                        class="slider_genre-item--link">{{ $item->name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="slider_content__derecription">
                                                        <a href="#"
                                                            class="slider_content__derecription-link">{{ $movie->description }}</a>
                                                    </div>
                                                </div>

                                                @php
                                                    $movie_episode_first = \App\Models\Episode::where('id_movie', $movie->id)->first();
                                                @endphp

                                                <div class="slider_content__icon">
                                                    <div class="slider_content__icon-play">
                                                        <a href="{{ route('watch', ['slug' => $movie->slug, 'episode' => $movie_episode_first->episode]) }}"
                                                            class="slider_content__icon-link">
                                                            <i class="fa-solid fa-play"></i>
                                                        </a>
                                                    </div>
                                                    <div class="slider_content__icon-collect">
                                                        <a href="#" class="slider_content__icon-link">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-6">

                                        </div>
                                        <div class="col-1">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <button class="carousel-control-prev btn_pre" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- end slider -->

        <!-- Movie hot -->
        <div class="movie_hot bg-black ">
            <h1 class="movie_hot__title display-2 fw-bolder  py-2 text-white ">Đề xuất hot</h1>

            <div class="row">
                @foreach ($hot_movie as $item)
                    <div class="col-2 my-3 ">
                        <a class="text-decoration-none text-white movie_hot__link"
                            href="{{ route('detail', ['slug' => $item->slug]) }}">
                            <div class="position-relative">
                                <img class="movie_hot__img w-100 d-block rounded  " src="{{ $item->thumb_url }}"
                                    alt="">
                                <div class="movie_hot__episode">
                                    <div class="movie_hot__episode">
                                        @if ($item->quality == 1)
                                            <span class="movie_hot__episode-text">HD -
                                                {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                        @elseif($item->quality == 0)
                                            <span class="movie_hot__episode-text">FullHD -
                                                {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="movie_hot__name">
                                <p class="movie_hot__title-name">{{ $item->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- emd Movie hot -->

        {{-- Movie in category --}}
        @foreach ($category as $ct)
            <div class="movie_hot bg-black ">
                <h1 class="movie_hot__title display-2 fw-bolder py-2"><b
                        class="movie_hot__title active">{{ $ct->name }}</b> mới cập nhật</h1>
                <div class="row">
                    @foreach ($series_movie as $item)
                        @if ($ct->id_category == $item->id_category)
                            <div class="col-2 my-3 ">
                                <a class="text-decoration-none text-white movie_hot__link"
                                    href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <div class="position-relative">
                                        <img class="movie_hot__img w-100 d-block rounded  " src="{{ $item->thumb_url }}"
                                            alt="">
                                        <div class="movie_hot__episode">
                                            <div class="movie_hot__episode">
                                                @if ($item->quality == 1)
                                                    <span class="movie_hot__episode-text">HD -
                                                        {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                                @elseif($item->quality == 0)
                                                    <span class="movie_hot__episode-text">FullHD -
                                                        {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="movie_hot__name">
                                        <p class="movie_hot__title-name">{{ $item->name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($cartoon as $item)
                        @if ($ct->id_category == $item->id_category)
                            <div class="col-2 my-3 ">
                                <a class="text-decoration-none text-white movie_hot__link"
                                    href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <div class="position-relative">
                                        <img class="movie_hot__img w-100 d-block rounded  " src="{{ $item->thumb_url }}"
                                            alt="">
                                        <div class="movie_hot__episode">
                                            <div class="movie_hot__episode">
                                                @if ($item->quality == 1)
                                                    <span class="movie_hot__episode-text">HD -
                                                        {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                                @elseif($item->quality == 0)
                                                    <span class="movie_hot__episode-text">FullHD -
                                                        {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="movie_hot__name">
                                        <p class="movie_hot__title-name">{{ $item->name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($single_movie as $item)
                        @if ($ct->id_category == $item->id_category)
                            <div class="col-2 my-3 ">
                                <a class="text-decoration-none text-white movie_hot__link"
                                    href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <div class="position-relative">
                                        <img class="movie_hot__img w-100 d-block rounded  " src="{{ $item->thumb_url }}"
                                            alt="">
                                        <div class="movie_hot__episode">
                                            <div class="movie_hot__episode">
                                                @if ($item->quality == 1)
                                                    <span class="movie_hot__episode-text">HD -
                                                        {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                                @elseif($item->quality == 0)
                                                    <span class="movie_hot__episode-text">FullHD -
                                                        {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="movie_hot__name">
                                        <p class="movie_hot__title-name">{{ $item->name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($theater_screening as $item)
                        @if ($ct->id_category == $item->id_category)
                            <div class="col-2 my-3 ">
                                <a class="text-decoration-none text-white movie_hot__link"
                                    href="{{ route('detail', ['slug' => $item->slug]) }}">
                                    <div class="position-relative">
                                        <img class="movie_hot__img w-100 d-block rounded  " src="{{ $item->thumb_url }}"
                                            alt="">
                                        <div class="movie_hot__episode">
                                            @if ($item->quality == 1)
                                                <span class="movie_hot__episode-text">HD -
                                                    {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                            @elseif($item->quality == 0)
                                                <span class="movie_hot__episode-text">FullHD -
                                                    {{ $item->language == 1 ? 'Vietsub' : 'Thuyết minh' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="movie_hot__name">
                                        <p class="movie_hot__title-name">{{ $item->name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

    </main>
@endsection
