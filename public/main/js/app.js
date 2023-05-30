$(document).ready(function () {
    let columnsData = {
        category_assets: [
            {
                data: "id",
                name: "id",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "user_created.name",
                name: "user_create",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "updated_at",
                name: "updated_at",
            },
        ],
        type_assets: [
            {
                data: "id",
                name: "id",
                responsivePriority: 2,
            },
            {
                data: "name",
                name: "name",
                responsivePriority: 2,
            },
            {
                data: "category_asset.name",
                name: "category_asset_id",
                responsivePriority: 2,
            },
            {
                data: "model",
                name: "model",
                responsivePriority: 2,
            },
            {
                data: "brand",
                name: "brand",
                responsivePriority: 2,
            },
            {
                data: "year_create",
                name: "year_create",
                responsivePriority: 2,
            },
            {
                data: "unit",
                name: "unit",
                responsivePriority: 2,
            },
            {
                data: null,
                name: "image",
                orderable: false,
                searchable: false,
                render: function (data) {
                    return `
                        <img style="width: 150px" src="${data.image}" alt="${data.name}"/>
                    `;
                },
                responsivePriority: 2,
            },
            {
                data: "user_create.name",
                name: "user_create",
                responsivePriority: 3,
            },

            {
                data: "created_at",
                name: "created_at",
                responsivePriority: 3,
            },
            {
                data: "updated_at",
                name: "updated_at",
                responsivePriority: 3,
            },
        ],
        suppliers: [
            {
                data: "id",
                name: "id",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "address",
                name: "address",
            },
            {
                data: "phone",
                name: "phone",
            },
            {
                data: "tax_code",
                name: "tax_code",
            },
            {
                data: "representative",
                name: "representative",
            }
        ]
    };
    console.log(columnsData);
    var currentRoute = route().current();
    var table = $("#data-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: route(currentRoute),
        columns: [
            ...columnsData[currentRoute],
            {
                data: null,
                orderable: false,
                searchable: false,
                responsivePriority: 1,
                render: function (data, type, row) {
                    let routeEdit = route(`${currentRoute}_edit`, data.id);
                    let routeDelete = route(`${currentRoute}_delete`, data.id);
                    return `
                <button data-href="${routeEdit}" data-id="${data.id}" title="Sửa" type="button" class="btn btn-primary btn-sm m-1 btn-action" data-toggle="modal" data-target="#modalCenter">
                    <i class="far fas fa-edit"></i>
                </button>
                
                <button data-href="${routeDelete}" data-id="${data.id}" title="Xóa" type="button" class="btn btn-danger btn-sm m-1 btn-action" data-toggle="modal" data-target="#modalCenter">
                    <i class="far fa-trash-alt"></i>
                </button>
            `;
                },
            },
        ],

        order: [
            [0, "desc"], // Sắp xếp cột đầu tiên (ID) theo thứ tự tăng dần
        ],
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        sorting: false,
        language: {
            paginate: {
                next: "&raquo;",
                previous: "&laquo;",
            },
        },
    });
    table.columns.adjust().responsive.recalc();
    let isRequest = false;

    let modalTitle = "";
    $(document).on("keyup", "input", function () {
        $(this).removeClass("is-invalid");
        $(this).siblings(".error-alert").empty();
    });
    $("#modalCenter").on("show.bs.modal", function (event) {

        var button = $(event.relatedTarget);
        modalTitle = button.attr("title");
        // var nameEdit = button.parents("tr").children("td:nth-child(2)").text();
        var id = button.attr('data-id') // lay id cua ban ghi
        var urlRequest = button.data("href");

        var modal = $(this);
        modal.find('.modal-body').empty()
        modal.find("#submit").attr({
            "data-href": urlRequest,
            title: modalTitle,
        });
        modal.find("span.title").text(modalTitle);
        // modal.find("#category_asset_name").val(nameEdit);

        if (modalTitle == "Xóa") {
            $("#modalCenter").find("form").hide();
            $(".delete-text").show();
            // $(".name-delete").text(nameEdit);
        } else {
            $("#modalCenter").find("form").show();
            $(".delete-text").hide();
        }
        setTimeout(() => {
            let data = { referrer: currentRoute };
            if (id != "") {
                data.id = id;
            }
            if(modalTitle == 'Xóa') {
                data.action = 'delete';
            }
            $.get(route("form-data"), data)
                .done(function(response) {
                    modal.find(".modal-body").html(response.data);
                    $('form select.form-control').select2({theme:"bootstrap"})
                })
                .fail(function() {
                    toastr.error("Đã có lỗi xảy ra");
                });
        }, 500);
    });

    $(document).on("click", "#submit", function (e) {
        e.preventDefault();
        if (!isRequest) {
            let $this = $(this);
            isRequest = true;
            $this.prop("disabled", true);

            let urlRequest = $this.attr("data-href");
            let csrfToken = $('meta[name="csrf-token"]').attr("content");

            let formData = new FormData($("#formData")[0]);
            formData.append("_token", csrfToken);
            // lay attr url dc truyen vao the script
            $.ajax({
                type: "POST",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": csrfToken, // Gửi mã thông báo CSRF trong header của request
                },
                url: urlRequest,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == "success") {
                        toastr.success(
                            `${modalTitle} loại tài sản thành công.`
                        );
                        $("#modalCenter").modal("hide");
                        $("#table-category-assets").html(response.table);
                        $("#category_asset_name").val("");
                        $("span.title").empty();
                        $(".is-invalid").removeClass("is-invalid");
                        table.ajax.reload();
                    }
                },
                error: function (response) {
                    if (response.status == "error") {
                        toastr.error("Đã có lỗi xảy ra");
                    } else {
                        let errors = response.responseJSON.errors;
                        for(feild in errors) {
                            $(`#error-${feild}`).text(errors[feild]);
                            $(`[name="${feild}"]`).addClass("is-invalid");
                        }
                    }
                },
                complete: function () {
                    isRequest = false;
                    $this.removeAttr("disabled");
                },
            });
        }
    });

    let imagePreview
    $(document).on('change', '.input-file-container input[type="file"]', function() {
        let file = this.files[0];
        imagePreview = URL.createObjectURL(file);
        $('.input-file-container').hide()
        $('.image_preview img').attr('src', imagePreview)
        $('.image_preview').show()
    })
    $(document).on('click', '.image_preview i', function () {
        $('.input-file-container input[type="file"]').val('');
        $('.input-file-container').show()
        $('.image_preview').hide()
        $('.image_preview img').attr('src', '');
        $('#image_old').val('');
        URL.revokeObjectURL(imagePreview);
    })

    $(document).on("keypress", "input[type='tel']", function (event) {
        var character = String.fromCharCode(event.keyCode);
        return /[0-9\s]/.test(character);
    });
});
