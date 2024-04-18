@extends('admin.layout.app')
@section('title', 'Tập phim')
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

                            <h2 class="card-title">Liệt kê tập phim</h2>
                            <div class="mb-3">
                                <a href="{{ route('episode.create') }}" class="btn btn-primary ">Thêm tập phim</a>
                            </div>

                            <table class="table table-bordered table-hover " id="TableMovie">
                                <thead>
                                    <tr class=" bg-secondary text-dark fw-bold ">
                                        <th> STT</th>
                                        <th> Tên phim</th>
                                        <th>Ảnh Phim </th>
                                        <th> Tập phim</th>
                                        <th> Tìm trạng</th>
                                        <th> Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_episodes as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->movie->name }} </td>
                                            {{-- <td>
                                                <iframe class="d-block" width="100%" height="250"
                                                    src="{{ $item->link_movie }}" title="" frameborder="0"
                                                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen></iframe>
                                            </td> --}}
                                            <td><img src="{{ $item->movie->poster_url }}" alt=""> </td>

                                            <td>
                                                <label class="badge badge-info">Tập - {{ $item->episode }}</label>
                                            </td>
                                            <td>
                                                @if ($item->episode == $item->movie->total_episodes)
                                                    <label class="badge badge-info">Full</label>
                                                @else
                                                    <label class="badge badge-info">Tập - {{ $item->episode }} /
                                                        {{ $item->movie->total_episodes }}</label>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('episode.edit', ['id_movie' => $item->movie->id, 'id_episode' => $item->id]) }}"
                                                        class="btn btn-primary">Sửa</a>

                                                    <form id="deleteForm" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            id="deleteButton_{{ $item->id }}">Xóa</button>
                                                    </form>

                                                    {{-- <form action="{{ route('episode.destroy', ['episode' => $item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form> --}}
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

    @foreach ($list_episodes as $find_id)
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
                                    "{{ route('episode.destroy', ['episode' => $find_id->id]) }}"
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
