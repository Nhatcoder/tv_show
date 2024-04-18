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

                            @foreach ($user as $find_id)
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
                                                        "{{ route('user-delete', ['id' => $find_id->id]) }}"
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

                            <h2 class="card-title">Danh sách người dùng</h2>

                            <table class="table table-bordered table-hover ">
                                <thead>
                                    <tr class=" bg-secondary text-dark fw-bold ">
                                        <th> STT</th>
                                        <th> Tên </th>
                                        <th> Ảnh </th>
                                        <th> Email </th>
                                        <th> Quyền </th>
                                        <th> Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td> <img src="{{ $item->avatar }}" alt=""> </td>
                                            <td> {{ $item->email }} </td>
                                            <td>
                                                
                                                @if ($item->role == 1)
                                                    <b class="badge badge-success">Admin</b>
                                                @else
                                                    <b class="badge badge-primary">User</b>
                                                @endif
                                            </td>
                                           
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('user-edit', ['id' => $item->id]) }}"
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
