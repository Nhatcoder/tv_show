@extends('admin.layout.app')
@section('title', 'Phim')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
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


                            <h2 class="card-title">Liệt kê thể loại</h2>
                            <div class="mb-3">
                                <a href="{{ route('movie.create') }}" class="btn btn-primary ">Thêm phim</a>
                            </div>
                            <div class="list_movies">
                                <table class="list_movies_scoll table table-bordered table-hover" id="TableMovie">
                                    <thead>
                                        <tr class=" bg-secondary text-dark fw-bold ">
                                            <th> STT</th>
                                            <th> Tên </th>
                                            <th> Ảnh đại diện </th>
                                            <th>Tổng số tập </th>
                                            <th>Thêm tập phim</th>
                                            <th> Thời lượng </th>
                                            <th> Danh mục </th>
                                            <th> Thể loại</th>
                                            <th> Chất lượng</th>
                                            <th> Ngôn ngữ</th>
                                            <th> Hot Slider</th>
                                            <th> Trạng thái </th>
                                            <th> Thao tác </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($movies as $key => $item)
                                            <tr>
                                                <td> {{ $key + 1 }} </td>
                                                <td> {{ $item->name }} </td>
                                                <td><img src="{{ $item->poster_url }}" alt=""> </td>
                                                <td>{{ $item->episode_count }}/{{ $item->total_episodes }}</td>
                                                <td><a href="{{ route('episode.create', ['id' => $item->id]) }}"
                                                        class="btn btn-success  ">Thêm tập
                                                        phim</a></td>
                                                <td>{{ $item->time }}</td>
                                                <td>
                                                    <select style="width: 150px"
                                                        class="form_change form-select form-control-sm select_category"
                                                        data-route="{{ route('movie-change-category') }}"
                                                        data-id="{{ $item->id }}">
                                                        @foreach ($category as $ct)
                                                            <option
                                                                {{ $item->category->id_category == $ct->id_category ? 'selected' : '' }}
                                                                value="{{ $ct->id_category }}">
                                                                {{ $ct->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    @foreach ($item->movie_genre as $genre)
                                                        <p class="badge badge-warning d-block m-1">{{ $genre->name }}</p>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @php
                                                        $selected_quality = $item->quality == 0 ? 'selected' : '';
                                                    @endphp
                                                    <select class="form_change form-select form-control-sm select_quality"
                                                        data-route="{{ route('movie-change-quality') }}"
                                                        data-id="{{ $item->id }}">
                                                        <option {{ $selected_quality }} value="1">HD</option>
                                                        <option {{ $selected_quality }} value="0">FullHD</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    @php
                                                        $selected_language = $item->language == 0 ? 'selected' : '';
                                                    @endphp
                                                    <select class="form_change form-select form-control-sm select_language"
                                                        data-route="{{ route('movie-change-language') }}"
                                                        data-id="{{ $item->id }}">
                                                        <option {{ $selected_language }} value="1">Vietsub</option>
                                                        <option {{ $selected_language }} value="0">Thuyết minh
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    @php
                                                        $selected_hot_slider = $item->hot_slider == 0 ? 'selected' : '';
                                                    @endphp
                                                    <select
                                                        class="form_change form-select form-control-sm select_hot_slider"
                                                        data-route="{{ route('movie-change-hot-slider') }}"
                                                        data-id="{{ $item->id }}">
                                                        <option {{ $selected_hot_slider }} value="1">Hiện</option>
                                                        <option {{ $selected_hot_slider }} value="0">Ẩn</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    @php
                                                        $selected_status = $item->status == 0 ? 'selected' : '';
                                                    @endphp
                                                    <select class="form_change form-select form-control-sm select_status"
                                                        data-route="{{ route('movie-change-status') }}"
                                                        data-id="{{ $item->id }}">
                                                        <option {{ $selected_status }} value="1">Hiện</option>
                                                        <option {{ $selected_status }} value="0">Ẩn</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('movie.edit', ['movie' => $item->id]) }}"
                                                            class="btn btn-primary  ">Sửa</a>
                                                        <form id="deleteForm" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                id="deleteButton_{{ $item->id }}">Xóa</button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
@endsection
