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
                                    {!! $movie->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-comment mt-5">
                    <div class="list-comment">
                        <div class="total_comment text-white">
                            <div class="total_comment__number">{{ count($listComent) > 0 ? count($listComent) : 0 }} bình
                                luận</div>
                            <div class="total_comment__sort">
                                <span><i class="fa-solid fa-bars-staggered"></i> Sắp xếp
                                    theo</span>
                                <div class="option_sort">
                                    <ul class="option_sort__list">
                                        <li class="option_sort__item">
                                            <button class="btn-link--confirm">Bình luận hàng đầu</button>
                                        </li>
                                        <li class="option_sort__item">
                                            <button class="btn-link--confirm">Bình luận mới nhất</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf

                    @if (Auth::check())
                        <div class="form-message">
                            <div class="form_message__avatar">
                                <img src="{{ filter_var($userNow->avatar, FILTER_VALIDATE_URL) ? $userNow->avatar : asset('images/images/user.png') }}"
                                    alt="">
                                {{-- <img src="{{ asset('images/') }}/images/user.png" alt=""> --}}
                            </div>

                            <div class="form_message__content">
                                <div contenteditable="true" class="comment"></div>
                                <div class="btn_send__comment">
                                    <button type="reset" class="btn btn-light btn-reset--comment">Hủy</button>
                                    <button id="btn-submit" class="btn btn-success btn-send">Bình
                                        luận</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="form-message">
                            <div class="form_message__avatar">
                                <img src="{{ asset('images/') }}/images/user.png" alt="">
                            </div>

                            <div class="form_message__content">
                                <div class="comment" @readonly(true)>Đăng nhập để bình luận</div>
                            </div>
                        </div>
                    @endif


                    <div id="list_comment__render">
                        @foreach ($listComent as $item)
                            <div class="list-comment">
                                <ul class="list_comment mt-4 text-white">
                                    <li class="list_comment__item d-flex justify-content-between align-items-start">
                                        <div class="d-flex">
                                            <div class="image_comment">
                                                <img src="{{ filter_var($item->user->avatar, FILTER_VALIDATE_URL) ? $item->user->avatar : asset('images/images/user.png') }}"
                                                    alt="">
                                            </div>

                                            <div class="action_comment">
                                                <div class="info_comment">
                                                    <p class="info_comment_title">{{ $item->user->name }} <span
                                                            class="info_comment_time">{{ $item->created_at }}</span></p>
                                                    <p class="info_comment_content">
                                                        {{ $item->comment }}
                                                    </p>
                                                </div>

                                                <div class="action_link mt-2">
                                                    <button class="btn-link--comment" data-id="{{ $item->id }}">
                                                        {{-- <i class="fa-solid fa-thumbs-up"></i> --}}
                                                        <i class="fa-regular fa-thumbs-up"></i>
                                                        5
                                                    </button>

                                                    <button class="btn-link--comment">
                                                        {{-- <i class="fa-solid fa-thumbs-down"></i> --}}
                                                        <i class="fa-regular fa-thumbs-up fa-rotate-180"></i>
                                                        5
                                                    </button>

                                                    <button class="btn-link--comment">
                                                        Phản hồi
                                                    </button>



                                                </div>

                                            </div>
                                        </div>

                                        {{-- <div class="action_comment__btn">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </div> --}}
                                    </li>
                                </ul>

                            </div>
                        @endforeach
                    </div>

                </div>
                <style>
                    .form-message {
                        display: flex;
                        justify-content: center;
                        align-items: start;
                        padding: 10px;
                        margin-top: 20px;
                    }

                    .form_message__avatar img {
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                    }

                    .btn_send__comment {
                        display: none;
                        position: absolute;
                        bottom: -45px;
                        right: 0;
                    }

                    .btn-send {
                        background: #157347;
                    }


                    .form_message__content {
                        width: 100%;
                        margin-left: 15px;
                        border-bottom: 1px solid #8a928c;
                        color: #fff;
                        transition: all 5s linear;
                        position: relative;
                        margin-top: 16px;
                    }

                    .form_message__content .comment {
                        width: 100%;
                        outline: none;
                        padding: 5px;
                        border: none;
                        background-color: transparent;
                        color: #fff;

                        white-space: pre-wrap;
                        word-wrap: break-word;
                        overflow-wrap: break-word;

                    }

                    .total_comment {
                        display: flex;
                        font-size: 20px;
                        font-weight: 500;
                    }

                    .option_sort {
                        display: none;
                        margin-top: 15px;
                    }

                    .total_comment__sort:hover .option_sort {
                        display: block;
                    }

                    .option_sort__list {
                        width: 200px;
                        background-color: #24252b;
                        position: absolute;
                        top: 100%;
                        left: 0;
                        z-index: 1;
                    }

                    .option_sort__list::after {
                        content: "";
                        display: block;
                        position: absolute;
                        top: -10px;
                        left: 10px;
                        width: 0;
                        height: 0;
                        border-left: 10px solid transparent;
                        border-right: 10px solid transparent;
                        border-bottom: 10px solid #24252b;
                    }


                    .btn-link--confirm {
                        font-size: 16px;
                        font-weight: 400;
                        border: none;
                        width: 100%;
                        background-color: #24252b;
                        outline: none;
                        color: #fff;
                        padding: 10px 20px;
                    }

                    .btn-link--confirm:hover {
                        background-color: #8a928c;
                        color: #3cde5b;
                    }

                    .total_comment__sort {
                        margin-left: 20px;
                        cursor: pointer;
                        font-size: 16px;
                        position: relative;
                    }

                    .total_comment__number {
                        font-weight: 700;
                    }

                    .list_comment {
                        /* display: flex; */
                        padding: 10px;
                    }

                    .image_comment img {
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                    }

                    .action_comment {
                        margin-left: 10px;
                    }

                    .info_comment_title {
                        font-size: 16px;
                        font-weight: 600;
                        color: #fff;
                    }

                    .info_comment_time {
                        font-size: 14px;
                        color: #8a928c;
                        font-weight: 400;
                    }

                    .info_comment_content {
                        font-size: 14px;
                        font-weight: 400;
                        color: #f0e9e9;
                        line-height: 1.4;
                        margin-top: 10px;
                        padding-right: 30px;
                    }

                    .action_comment__btn {
                        margin-top: 30px;
                        cursor: pointer;
                        padding: 7px 13.5px;
                        border: 1px solid transparent;
                        border-radius: 50%;
                    }

                    .action_comment__btn:hover {
                        padding: 7px 13.5px;
                        border: 1px solid #fff;
                        border-radius: 50%;
                    }

                    .btn-link--comment {
                        color: #fff;
                        border: none;
                        padding-left: 0;
                        background-color: transparent;
                        outline: none;

                    }
                </style>
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


@section('script')
    <script type="module">
        window.Echo.channel('comment.{{ $movie->id }}')
            .listen('Comment', (e) => {
                console.log(e);
                $('#list_comment__render').prepend(e.comment);
            })
    </script>

    <script>
        $(document).ready(function() {
            $(".btn-reset--comment").on("click", function() {
                $(".comment").text("");
            })

            $(".comment").on("keyup", function() {
                let comment = $(this).text().trim();
                if (comment.length > 0) {
                    $("#btn-submit").removeClass("btn-send");
                    $(".btn_send__comment").show(300);
                } else {
                    $("#btn-submit").addClass("btn-send");
                }
            });

            $(".comment").on("blur", function() {
                $(".btn_send__comment").stop(true).fadeToggle(300);
            });

            $("#btn-submit").on("click", function() {
                let comment = $(".comment").text().trim();
                if (comment.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('movieComment') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            comment,
                            movie_id: "{{ $movie->id }}",
                        },
                        success: function() {
                            $(".comment").text("");
                            $("#btn-submit").addClass("btn-send");
                        },
                    })

                }
            });

            $(document).on("click", ".btn-link--comment", function() {
                // alert("ok: "+$(this).data('id'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('movieCommentLike') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        comment_id: $(this).data('id'),
                    },
                    success: function() {
                        // alert("ok");
                    },
                })


            })
        });
    </script>
@endsection
