@extends('user.layout.app')

@section('main')
    <main>
        <div class="movie__watch px-5 pt-3">
            <div class="row g-0 movie__watch__bg">
                <div class="col-9">
                    <iframe class="d-block" width="100%" height="620" src="{{ $episode->link_movie }}"
                        title="{{ $movie->name }}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen autoplay muted></iframe>

                </div>

                {{-- Tập phim tập --}}
                @if (count($movie->episode) > 2)
                    <div class="col-3">
                        <div class="movie__watch-content p-4">
                            <h2 class="fs-3 text-white fw-bold">{{ $movie->name }}</h2>
                            <h3 class="py-4 text-white">Chọn tập 1-{{ $movie->total_episodes }}
                                {{ count($movie->episode) == $movie->total_episodes ? '' : 'Đang cập nhật' }}</h3>
                            <div class="movie__watch__total_episodes">
                                <div class="row">
                                    @foreach ($movie->episode as $item)
                                        <div class="col-2 mb-2">
                                            <a href="{{ route('watch', ['slug' => $movie->slug, 'episode' => $item->episode]) }}"
                                                class="movie__watch__episode-link {{ isset($episode) && $episode->episode == $item->episode ? 'active' : '' }}">{{ $item->episode }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-3">
                        <div class="movie__watch-content p-4">
                            <h2 class="fs-5 text-white fw-bold text-capitalize lh-base">{{ $movie->name }}
                            </h2>
                            <div class="mt-4 mb-3 ">
                                <a href="{{ route('detail', ['slug' => $movie->slug]) }}"
                                    class="movie_watch__relate-item active">
                                    <img class="movie_watch__relate-item--img rounded" src="{{ $movie->thumb_url }}"
                                        alt="{{ $movie->name }}">
                                    <p>{{ $movie->name }}</p>
                                </a>
                            </div>

                            <div class="movie_watch__relate">
                                <h4 class="movie_watch__relate-title">Đề xuất liên quan</h4>
                                @foreach ($movie_related as $item)
                                    <a href="{{ route('detail', ['slug' => $item->slug]) }}"
                                        class="movie_watch__relate-item mb-2">
                                        <img class="movie_watch__relate-item--img rounded" src="{{ $item->thumb_url }}"
                                            alt="{{ $item->name }}">
                                        <p class="text-capitalize ">{{ $item->name }}</p>
                                    </a>
                                @endforeach
                            </div>


                        </div>
                    </div>
                @endif
            </div>

            {{-- Description --}}
            <div class="movie__watch__description pb-4">
                <div class="row g-0">
                    <div class="col-12 text-white movie_detail-content">
                        <div class="movie_detail__item mt-5 pt-4">
                            <h1 class="fs-1 fw-bold text-capitalize ">{{ $movie->name }} - Tập
                                {{ $episode->episode }}</h1>
                        </div>
                        <div class="movie_detail__content">
                            <ul class="movie_detail__time">
                                <li class="movie_detail__time-list">
                                    <a href="#" class="movie_detail__time-list--link star">
                                        <i class="fa-solid fa-star"></i>
                                        9.1
                                    </a>
                                </li>
                                <li class="movie_detail__time-list">
                                    <a href="#" class="movie_detail__time-list--link">
                                        T13
                                    </a>
                                </li>
                                <li class="movie_detail__time-list">
                                    <a href="#" class="movie_detail__time-list--link">
                                        2022
                                    </a>
                                </li>
                                <li class="movie_detail__time-list">
                                    <a href="#" class="movie_detail__time-list--link">
                                        {{ $movie->time }}
                                    </a>
                                </li>
                            </ul>

                            <ul class="movie_detail__category d-flex">
                                @foreach ($movie->movie_genre as $item)
                                    <li class="movie_detail__category-list">
                                        <a href="#" class="movie_detail__category-list--link">
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="movie_detail__item d-flex mt-3">
                                <div class="movie_detail__item-list--description"><strong
                                        class="movie_detail__item-title">Diễn
                                        viên:
                                    </strong>
                                    @foreach (explode('"', str_replace('"', '', $movie->casts)) as $cast)
                                        <span
                                            class="movie_detail__item-list--link text-decoration-none ps-1">{{ trim($cast) }}.</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="movie_detail__item d-flex mt-4">
                                <div class="movie_detail__item-list--description"><strong
                                        class="movie_detail__item-title">Miêu
                                        tả:</strong>
                                    {{ $movie->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- hot --}}
        <div class="movie_hot bg-black ">
            <h1 class="movie_hot__title display-2 fw-bolder  py-2 text-white ">Đề xuất hot</h1>
            <div class="row">
                @foreach ($movie_related as $item)
                    <div class="col-2 my-3 ">
                        <a class="text-decoration-none text-white movie_hot__link"
                            href="{{ route('detail', ['slug' => $item->slug]) }}">
                            <div class="position-relative">
                                <img class="movie_hot__img w-100 d-block rounded  " src="{{ $item->thumb_url }}"
                                    alt="">
                                <div class="movie_hot__episode">
                                    <div class="movie_hot__episode">
                                        @if ($item->quality == 1)
                                            <span class="movie_hot__episode-text">HD - Vietsub</span>
                                        @elseif($item->quality == 2)
                                            <span class="movie_hot__episode-text">FullHD - Thuyết minh</span>
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



    </main>
@endsection
