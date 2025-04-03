@extends('user.layout.app')

@section('main')
    <main class="main_detail">
        <!-- movie_detail -->
        <div class="movie_detail">
            <div class="row g-0">
                <div class="col-5 text-white px-5 movie_detail-content">
                    <div class="movie_detail__item mt-5 pt-4">
                        <h1 class="fs-1 fw-bold">{{ $movie_detail->name }}</h1>
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
                                    {{ $movie_detail->time }}
                                </a>
                            </li>
                        </ul>

                        <ul class="movie_detail__category d-flex">
                            @foreach ($movie_detail->movie_genre as $item)
                                <li class="movie_detail__category-list">
                                    <a href="#" class="movie_detail__category-list--link">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>


                        <div class="movie_detail__item d-flex mt-4">
                            <div class="movie_detail__item-list--description"><strong class="movie_detail__item-title">Đạo
                                    diễn:
                                </strong>
                                <span
                                    class="movie_detail__item-list--link text-decoration-none ps-1">{{ $movie_detail->director }}</span>
                            </div>
                        </div>
                        <div class="movie_detail__item d-flex mt-3">
                            <div class="movie_detail__item-list--description"><strong class="movie_detail__item-title">Diễn
                                    viên:
                                </strong>
                                @foreach (explode('"', str_replace('"', '', $movie_detail->casts)) as $cast)
                                    <span
                                        class="movie_detail__item-list--link text-decoration-none ps-1">{{ trim($cast) }}</span>
                                @endforeach
                            </div>
                        </div>


                        <div class="movie_detail__item d-flex mt-3">
                            <div class="movie_detail__item-list--description"><strong class="movie_detail__item-title">Miêu
                                    tả:</strong>
                                {{ $movie_detail->description }}
                            </div>
                        </div>

                        <div class="movie_detail__btn">
                            <div class="movie_detail__btn-click active">
                                <i class="fa-solid fa-play"></i>
                                @if ($movie_episode_first)
                                    <a href="{{ route('watch', ['slug' => $movie_detail->slug, 'episode' => $movie_episode_first->episode]) }}"
                                        class="movie_detail__btn-link">Chiếu
                                        phát</a>
                                @else
                                    <a href="#" class="movie_detail__btn-link">Đang cập nhật
                                    </a>
                                @endif

                            </div>
                            <div class="movie_detail__btn-click">
                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                <a href="#" class="movie_detail__btn-link">Chia sẻ</a>
                            </div>
                            <div class="movie_detail__btn-click">
                                <i class="fa-solid fa-arrow-down"></i>
                                <a href="#" class="movie_detail__btn-link">App</a>
                            </div>
                            <div class="movie_detail__btn-click">
                                <i class="fa-solid fa-plus"></i>
                                <a href="#" class="movie_detail__btn-link">Sưu tập</a>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- <div class="col-7 position-relative "> --}}
                <div class="col-7  ">
                    <div class="movie_detail__img position-relative">
                        {{-- <img class="w-100 d-block" src="{{ $movie_detail->poster_url }}" alt="bg"> --}}
                        <img class="movie_detail__img-bg" src="{{ $movie_detail->poster_url }}" alt="bg">
                        <div class="left-layer"></div>
                        <div class="bottom-layer"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end movie_detail -->

        <h2 class="movie_hot__title display-2 fw-bolder py-2 text-white px-5 mt-5">Phim liên quan</h2>

        <div class="movie_hot px-5 pt-1">
            <div class="row">
                @foreach ($movie_related as $item)
                    <div class="col-2 my-3 ">
                        <a class="text-decoration-none text-white movie_hot__link"
                            href="{{ route('detail', ['slug' => $item->slug]) }}">
                            <div class="position-relative">
                                <img class="movie_hot__img w-100 d-block rounded  " src="{{ $item->thumb_url }}"
                                    alt="">
                                <div class="movie_hot__episode">
                                    <span class="movie_hot__episode-text">HD - Vietsub</span>
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

        {{-- <div class="movie_tabnav mt-5 px-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Đề xuất cho
                        bạn</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Bình
                        luận</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="movie_hot px-0 pt-2">
                        <div class="row">
                            @foreach ($movie_related as $item)
                                <div class="col-2 my-3 ">
                                    <a class="text-decoration-none text-white movie_hot__link"
                                        href="{{ route('detail', ['slug' => $item->slug]) }}">
                                        <div class="position-relative">
                                            <img class="movie_hot__img w-100 d-block rounded  "
                                                src="{{ $item->thumb_url }}" alt="">
                                            <div class="movie_hot__episode">
                                                <span class="movie_hot__episode-text">HD - Vietsub</span>
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
                </div>
                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel"
                    aria-labelledby="profile-tab" tabindex="0">
                    <div class="box-comment bg-white p-4">
                        <div class="list-comment">
                            <ul>
                                <li>Comment</li>
                                <li>Comment</li>
                                <li>Comment</li>
                            </ul>
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea name="comment" id="comment" placeholder="Viết bình luận ..." class="form-control" cols="30"
                                    rows="5"></textarea>
                        </form>
                    </div>
                    <style>
                

                        #comment:focus {
                            border: 1px solid #000;
                            box-shadow: none;
                        }
                    </style>



           
                </div>
            </div>
        </div> --}}
    </main>
@endsection
