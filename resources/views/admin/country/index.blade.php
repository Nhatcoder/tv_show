@extends('admin.layout.app')
@section('title', 'Danh mục')
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

                            @foreach ($countries as $find_id)
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        document.getElementById('deleteButton_{{ $find_id->id }}').addEventListener('click', function(
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
                                                        "{{ route('country.destroy', ['country' => $find_id->id]) }}"
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
                                    });
                                </script>
                            @endforeach

                            <h2 class="card-title">Liệt kê quốc gia</h2>
                            <div class="mb-3">
                                <a href="{{ route('country.create') }}" class="btn btn-primary ">Thêm quốc gia</a>
                            </div>
                            <table class="table table-bordered table-hover ">
                                <thead>
                                    <tr class=" bg-secondary text-dark fw-bold ">
                                        <th> STT</th>
                                        <th> Tên </th>
                                        <th> Slug </th>
                                        <th> Trạng thái </th>
                                        <th> Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td>{{ $item->slug }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <label class="badge badge-success">Hiện</label>
                                                @else
                                                    <label class="badge badge-secondary">Ẩn</label>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('country.edit', ['country' => $item->id]) }}"
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
@endsection
