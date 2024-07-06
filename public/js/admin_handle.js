// update status movie
$('.select_status').on('change', function () {
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
        success: function () {
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
$('.select_language').on('change', function () {
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
        success: function () {
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
$('.select_quality').on('change', function () {
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
        success: function () {
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
$('.select_hot_slider').on('change', function () {
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
        success: function () {
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
$('.select_category').on('change', function () {
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
        success: function () {
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



