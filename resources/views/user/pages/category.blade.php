@extends('user.layout.app')

@section('main')
    <main class="pt-5 ">
        <!-- Movie hot -->
        <div class="movie_hot bg-black ">
            <h1 class="movie_hot__title display-2 fw-bolder py-2"> Danh sách <b
                    class="movie_hot__title active text-lowercase ">{{ $category_slug->name }}</b>
                </b>
            </h1>
            <div class="row">
                @foreach ($category_movie as $movie)
                    <div class="col-2 my-3 ">
                        <a class="text-decoration-none text-white movie_hot__link" href="{{ route('detail', ['slug'=>$movie->slug]) }}">
                            <div class="position-relative">
                                <img class="movie_hot__img w-100 d-block rounded  " src="{{ $movie->thumb_url }}"
                                    alt="{{ $movie->name }}" title="{{ $movie->name }}">
                                <div class="movie_hot__episode">
                                    <span class="movie_hot__episode-text">HD - Vietsub</span>
                                </div>
                            </div>
                            <div class="movie_hot__name">
                                <p class="movie_hot__title-name">{{ $movie->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- resources/views/components/pagination.blade.php -->
            {{-- Phân trang --}}
            @if ($category_movie->lastPage() > 1)
                <div class="col-12 movie_movie_pagination__list text-center mt-5 pt-2">
                    <ul class="movie_pagination__list">
                        {{-- Nút Previous --}}
                        @if ($category_movie->onFirstPage())
                            <li><span class="movie_pagination__list-link btn_pagination__left disabled"><i
                                        class="fa-solid fa-angles-left"></i></span></li>
                        @else
                            <li><a class="movie_pagination__list-link btn_pagination__left"
                                    href="{{ $category_movie->previousPageUrl() }}"><i
                                        class="fa-solid fa-angles-left"></i></a></li>
                        @endif

                        {{-- Các trang --}}
                        @php
                            $currentPage = $category_movie->currentPage();
                            $lastPage = $category_movie->lastPage();

                            // Hiển thị 3 trang đầu và 1 trang cuối
                            $startPage = max($currentPage - 2, 1);
                            $endPage = min($currentPage + 2, $lastPage);

                            // Nếu trang hiện tại gần cuối, chỉ hiển thị 4 trang
                            if ($currentPage >= $lastPage - 2) {
                                $startPage = $lastPage - 2;
                                $endPage = $lastPage;
                            }

                            // Nếu trang hiện tại là trang cuối cùng, chỉ hiển thị trang 1
                            if ($currentPage === $lastPage) {
                                $startPage = 1;
                                $endPage = 2;
                            }
                        @endphp
                        {{-- Hiển thị trang đầu --}}
                        @if ($startPage > 1)
                            <li>
                                <a class="movie_pagination__list-link" href="{{ $category_movie->url(1) }}">1</a>
                            </li>
                            {{-- Hiển thị dấu ba chấm --}}
                            @if ($startPage > 3)
                                <li>
                                    <span class="movie_pagination__list-link">...</span>
                                </li>
                            @endif
                        @endif

                        {{-- Hiển thị các trang --}}
                        @for ($i = 1; $i <= $endPage; $i++)
                            <li>
                                <a class="movie_pagination__list-link {{ $i == $category_movie->currentPage() ? 'active' : '' }}"
                                    href="{{ $category_movie->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Hiển thị trang cuối --}}
                        @if ($endPage < $lastPage)
                            {{-- Hiển thị dấu ba chấm --}}
                            @if ($endPage < $lastPage - 1)
                                <li>
                                    <span class="movie_pagination__list-link">...</span>
                                </li>
                            @endif
                            <li>
                                <a class="movie_pagination__list-link"
                                    href="{{ $category_movie->url($lastPage) }}">{{ $lastPage }}</a>
                            </li>
                        @endif

                        {{-- Nút Next --}}
                        @if ($category_movie->hasMorePages())
                            <li><a class="movie_pagination__list-link btn_pagination__right"
                                    href="{{ $category_movie->nextPageUrl() }}"><i
                                        class="fa-solid fa-angles-right"></i></a></li>
                        @else
                            <li><span class="movie_pagination__list-link btn_pagination__right disabled"><i
                                        class="fa-solid fa-angles-right"></i></span></li>
                        @endif
                    </ul>
                </div>
            @endif




        </div>
        <!-- emd Movie hot -->



    </main>
@endsection
