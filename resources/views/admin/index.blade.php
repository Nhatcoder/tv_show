@extends('admin.layout.app')
@section('title', 'Cp')
@section('content')
    <div class="main-panel">

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: "success",
                    title: "Thành công ",
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 1600
                });
            </script>
        @endif

        @if (session('warning'))
            <script>
                Swal.fire({
                    icon: "warning",
                    title: "Ôi lỗi ! ",
                    text: "{{ session('warning') }}",
                    showConfirmButton: false,
                    timer: 1600
                });
            </script>
        @endif

        @foreach ($movies as $find_id)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var deleteButton = document.getElementById('deleteButton_{{ $find_id->id }}');
                    if (deleteButton) {
                        deleteButton.addEventListener('click', function(
                            e) {
                            e.preventDefault()
                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: "btn btn-success",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });

                            swalWithBootstrapButtons.fire({
                                title: "Bạn có chắc không ?",
                                text: "Bạn sẽ không thể hoàn nguyên điều này ",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonText: "Xóa",
                                cancelButtonText: "Hủy",
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    let btn_delete = document.getElementById('deleteForm');
                                    btn_delete.setAttribute("action",
                                        "{{ route('movie.destroy', ['movie' => $find_id->id]) }}"
                                    );
                                    btn_delete.submit()

                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    swalWithBootstrapButtons.fire({
                                        title: "Đã Hủy",
                                        text: "Hủy thành công ",
                                        icon: "error",
                                        showConfirmButton: false,
                                        timer: 1600
                                    });
                                }
                            });
                        });
                    }

                });
            </script>
        @endforeach
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-sm-flex align-items-baseline report-summary-header">
                                        <h5 class="font-weight-semibold">Báo cáo tóm tắt</h5> <span class="ml-auto">Báo cáo
                                            đã cập nhật
                                        </span> <button class="btn btn-icons border-0 p-2"><i
                                                class="icon-refresh"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row report-inner-cards-wrapper">
                                <div class=" col-md -6 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">Phim cập nhật hôm nay </span>
                                        <h4>{{ $movieUpdateToday }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-success">
                                        <i class="icon-rocket"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">Thể loại phim</span>
                                        <h4>{{ $genre_total }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-danger">
                                        <i class="icon-briefcase"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">Phim đã thêm</span>
                                        <h4>{{ $movie_total }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-primary">
                                        <i class="icon-film"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">Phim chưa thêm tập</span>
                                        <h4>{{ $moviesIncomplete }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-warning">
                                        <i class="icon-globe-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex align-items-center mb-4">
                                <h4 class="card-title mb-sm-0">Phim cập nhật hàng ngày</h4>
                                <a href="{{ route('add-full', ['page' => isset($_GET['page']) ? $_GET['page'] : 1]) }}"
                                    class="btn btn-primary text-dark ml-auto mb-3 mb-sm-0"> Đồng bộ</a>
                            </div>
                            <div class="list_movies">
                                <table class="list_movies_scoll table table-bordered table-hover ">
                                    <thead>
                                        <tr class=" bg-secondary text-dark fw-bold ">
                                            <th> STT</th>
                                            <th> Tên </th>
                                            <th> Ảnh nhỏ </th>
                                            <th> Ảnh to </th>
                                            <th>Tình trạng</th>
                                            <th> Thao tác </th>
                                            <th>Tên tiếng anh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <style>
                                            .table td img {
                                                width: 100px;
                                                height: 100px;
                                                border-radius: 0;
                                            }
                                        </style>

                                        @foreach ($data['items'] as $key => $item)
                                            @php
                                                $check_movie = \App\Models\Movie::withCount('episode')
                                                    ->where('slug', $item['slug'])
                                                    ->first();
                                                // dd($check_movie);
                                            @endphp
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item['name'] }} </td>
                                                <td>
                                                    <img src="{{ $item['thumb_url'] }}" width="150px" alt="">
                                                </td>
                                                <td>
                                                    <img src="{{ $item['poster_url'] }}" width="150px" alt="">
                                                </td>

                                                @if (isset($check_movie) && $check_movie->name == $item['name'])
                                                    <td><b>{{ $check_movie->episode_count }}/{{ $check_movie['total_episodes'] }}</b>
                                                    </td>
                                                @else
                                                    <td>Chưa có phim chưa có tập</td>
                                                @endif


                                                <td>
                                                    <div class="d-flex">
                                                        @if (!$check_movie)
                                                            <form
                                                                action="{{ route('add-movie', ['slug' => $item['slug']]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-info">Thêm
                                                                    Phim</button>
                                                            </form>
                                                        @else
                                                            <form id="deleteForm" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    id="deleteButton_{{ $check_movie->id }}">Xóa</button>
                                                            </form>
                                                        @endif

                                                        @if ($check_movie && $check_movie->episode_count != $check_movie->total_episodes)
                                                            <form
                                                                action="{{ route('add-movie-episode', ['slug' => $item['slug']]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Thêm
                                                                    tập</button>
                                                            </form>
                                                        @elseif ($check_movie)
                                                            <button class="btn btn-primary">Full tập</button>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td style="white-space: none;"> {{ $item['original_name'] }} </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            {{-- Phân trang --}}
                            <div class="d-flex mt-4 flex-wrap">
                                <p class="text-muted">Hiển thị 10 phim của {{ $data['paginate']['total_items'] }}</p>
                                <nav class="ml-auto">
                                    @php
                                        $total_pages = ceil($data['paginate']['total_items'] / 10);
                                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $start_page = max(1, $current_page - 2);
                                        $end_page = min($total_pages, $start_page + 4);
                                    @endphp

                                    <ul class="pagination separated pagination-info">
                                        <li class="page-item"><a href="?page={{ max(1, $current_page - 1) }}"
                                                class="page-link"><i class="fas fa-arrow-left"></i>
                                            </a></li>
                                        @for ($i = $start_page; $i <= $end_page; $i++)
                                            <li class="page-item {{ $i == $current_page ? 'active' : '' }}"><a
                                                    href="?page={{ $i }}"
                                                    class="page-link">{{ $i }}</a></li>
                                        @endfor
                                        <li class="page-item"><a href="?page={{ min($total_pages, $current_page + 1) }}"
                                                class="page-link"><i class="fas fa-arrow-right"></i>
</a></li>
                                    </ul>

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                        phimhay-admin</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Vip <a
                            href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bản quyền thuộc
                            về</a> Trần Nhật</span>
                </div>
            </footer>
        </div>

        <!-- partial -->
    </div>


    <script>
        const container = document.querySelector('.list_movies');
        let isDragging = false;
        let startX;
        let scrollLeft;

        container.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
        });

        container.addEventListener('mouseleave', () => {
            isDragging = false;
        });

        container.addEventListener('mouseup', () => {
            isDragging = false;
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 2;
            container.scrollLeft = scrollLeft - walk;
        });
    </script>
@endsection
