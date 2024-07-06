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

                            <h2 class="card-title">Liệt kê phim</h2>
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="pt-3">
                                    <a href="{{ route('movie.create') }}" class="btn btn-primary ">Thêm phim</a>
                                </div>
                                <div class="form-fillter d-flex align-items-center">
                                    <div class="form-group">
                                        <label for="search mb-0">Tìm kiếm </label>
                                        <input type="text" class="form-control" style="width: 400px;" id="search_movie"
                                            placeholder="Tìm kiếm">
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục</label>
                                        <select class="form-control" data-route="{{ route('movieSearch') }}"
                                            id="fillter_category_movie" style="width:100%">
                                            <option value="" selected>Chọn danh mục</option>
                                            @foreach ($category as $ct)
                                                <option value="{{ $ct->id_category }}">
                                                    {{ $ct->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="list_movies">
                                @include('admin.movie.movie_search')
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

    <script>
        $("#fillter_category_movie").on('change', function() {
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('movieSearch') }}",
                type: "POST",
                data: {
                    category_id: category_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    $(".list_movies").html(data.view);

                    // update status movie
                    $('.select_status').on('change', function() {
                        var status = $(this).val();
                        var id = $(this).attr('data-id');
                        var route = $(this).attr('data-route');
                        // console.log(route);
                        // alert(id + "----" + status)
                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                status: status
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật trạng thái thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                        })
                    })

                    // update language
                    $('.select_language').on('change', function() {
                        let language = $(this).val();
                        let id = $(this).attr('data-id');
                        let route = $(this).attr('data-route');
                        // alert(id + "----" + language + "----" + route)

                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                language: language
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật ngôn ngữ thành công thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })

                    })


                    // Update quality
                    $('.select_quality').on('change', function() {
                        var quality = $(this).val();
                        var id = $(this).attr('data-id');
                        var route = $(this).attr('data-route');
                        // var route = routes.changeQuality;
                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                quality: quality
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật chất lượng thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                    })

                    // update hot_slider
                    $('.select_hot_slider').on('change', function() {
                        var hot_slider = $(this).val();
                        var id = $(this).attr('data-id');
                        var route = $(this).attr('data-route');
                        // var route = routes.changeQuality;
                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                hot_slider: hot_slider
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật hot slider thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                    })
                    // update select_category
                    $('.select_category').on('change', function() {
                        var id_category = $(this).val();
                        var id = $(this).attr('data-id');
                        var route = $(this).attr('data-route');
                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                id_category: id_category
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật danh mục thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                    })
                }
            })
        })

        $(document).on("input", "#search_movie", function() {
            var value = $(this).val().toLowerCase();

            $.ajax({
                url: "{{ route('movieSearch') }}",
                type: "POST",
                data: {
                    search: value,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    $(".list_movies").html(data.view);

                    // update status movie
                    $('.select_status').on('change', function() {
                        var status = $(this).val();
                        var id = $(this).attr('data-id');
                        var route = $(this).attr('data-route');
                        // console.log(route);
                        // alert(id + "----" + status)
                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                status: status
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật trạng thái thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                        })
                    })

                    // update language
                    $('.select_language').on('change', function() {
                        let language = $(this).val();
                        let id = $(this).attr('data-id');
                        let route = $(this).attr('data-route');
                        // alert(id + "----" + language + "----" + route)

                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                language: language
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật ngôn ngữ thành công thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })

                    })


                    // Update quality
                    $('.select_quality').on('change', function() {
                        var quality = $(this).val();
                        var id = $(this).attr('data-id');
                        var route = $(this).attr('data-route');
                        // var route = routes.changeQuality;
                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                quality: quality
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật chất lượng thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                    })

                    // update hot_slider
                    $('.select_hot_slider').on('change', function() {
                        var hot_slider = $(this).val();
                        var id = $(this).attr('data-id');
                        var route = $(this).attr('data-route');
                        // var route = routes.changeQuality;
                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                hot_slider: hot_slider
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật hot slider thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                    })
                    // update select_category
                    $('.select_category').on('change', function() {
                        var id_category = $(this).val();
                        var id = $(this).attr('data-id');
                        var route = $(this).attr('data-route');
                        $.ajax({
                            url: route,
                            type: 'GET',
                            data: {
                                id: id,
                                id_category: id_category
                            },
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công ",
                                    text: "Cập nhật danh mục thành công",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                    })

                }
            });
        });

        $(document).on("click", ".btn_delete_movie", function() {
            var id = $(this).data('id');
            var elementTr = $(this).closest('tr');

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
                    $.ajax({
                        url: "{{ route('movieDelete') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            elementTr.remove();

                            Swal.fire({
                                icon: "success",
                                title: "Thành công ",
                                text: "Xoá phim thành công",
                                showConfirmButton: false,
                                timer: 1600
                            });
                        }
                    });
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




        })
    </script>
@endsection
