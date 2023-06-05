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
                data: "user_created.name",
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
            },
        ],
        orders: [
            {
                data: "id",
                name: "id",
            },
            {
                data: "code",
                name: "code",
            },
            {
                data: "supplier.name",
                name: "supplier_id",
            },
            {
                data: "formatted_order_date",   
                name: "order_date",
            },
            {
                data: "formatted_delivery_date",
                name: "delivery_date",
            },
            {
                data: "delivery_address",
                name: "delivery_address",
            },
            {
                data: "payment_method_text",
                name: "payment_methods",
            },
            {
                data: "user_created.name",
                name: "user_create",
            },
            {
                data: "created_at",
                name: "created_at",
            },
        ],
        users: [
            {
                data: "id",
                name: "id",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "updated_at",
                name: "updated_at",
            },
            {
                data: null,
                name: "status",
                render: function (data) {
                    let color = 'success';
                    let text = 'Hoạt động';
                    if(data.status == 0) {
                        color = 'danger';
                        text = 'Vô hiệu hóa';
                    }
                    return `
                        <p class="text-${color}">${text}</p>
                    `;
                },
            },
        ],
        roles: [
            {
                data: "id",
                name: "id",
            },
            {
                data: "name",
                name: "name",
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
    };

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
                    return getActionButtons(data);
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
        var id = button.attr("data-id"); // lay id cua ban ghi
        var urlRequest = button.attr("data-href"); 
        var action = button.attr("data-action")
        
        var modal = $(this);
        modal.find(".modal-body").empty();
        modal.find("#submit").attr({
            "data-href": urlRequest,
            title: modalTitle,
        });
        modal.find("span.title").text(modalTitle);

        if (modalTitle == "Xóa") {
            $("#modalCenter").find(".size-lg").removeClass("modal-lg");
            $("#modalCenter").find(".size-hg").removeClass("modal-hg");

        } else {
            $("#modalCenter").find(".size-lg").addClass("modal-lg");
            $("#modalCenter").find(".size-hg").addClass("modal-hg");

        }
        setTimeout(() => {
            let data = { 
                referrer: currentRoute,
                action: action
             };
            if (id != "") {
                data.id = id;
            }
           
            $.get(route("form-data"), data)
                .done(function (response) {
                    modal.find(".modal-body").html(response.data);
                    $("form select.form-control").select2({
                        theme: "bootstrap",
                    });
                    if ($('select[multiple="multiple"]').length) {
                        // js cua orders
                        $('select[multiple="multiple"]').multiselect({
                            disable: true,
                            selectAllText: " Chọn tất cả",
                            enableFiltering: true,
                            filterPlaceholder: "Tìm kiếm",
                            allSelectedText: "Đã chọn",
                            buttonWidth: "100%",
                            buttonTextAlignment: "left",
                            onChange: function (option, checked) {
                                if(checked) {
                                    let id = $('.list_assets tbody tr').length
                                    let categoryAsset = $('#category_assets option:selected').text()
                                    let td = `<tr data-id="${ option[0].value }">
                                                <td>${ id + 1 }</td>
                                                <td>${ option[0].text } <input type="hidden" name="type_asset_id[]" value="${ option[0].value }"/></td>
                                                <td>${ categoryAsset }</td>
                                                <td>${ option[0].dataset.unit }</td>
                                                <td><input type="tel" name="price[]" class="form-control" placeholder="Nhập đơn giá"/> 
                                                    <span id="error-price${id}" class="text-danger font-italic error-alert"></span>
                                                </td>
                                                <td><input type="tel" name="quantity[]" class="form-control" placeholder="Nhập số lượng"/>
                                                    <span id="error-quantity${id}" class="text-danger font-italic error-alert"></span>
                                                </td>
                                                <td class="text-center"><i id="remove${ option[0].value }" class="fas fa-times"></i></td>
                                            </tr>`;
                                    $('.list_assets tbody').append(td)
                                    $('#error-type_asset_id').empty()
                                } else {
                                    $('i#remove' + option[0].value).click(); // remove khi bo chon trong selects
                                }
                            },
                        });
                    }
                })
                .fail(function () {
                    toastr.error("Đã có lỗi xảy ra");
                });
        }, 500);
    });

    $(document).on("click", "#submit", function (e) {
        e.preventDefault();
        if (!isRequest) {
            let $this = $(this);
            // isRequest = true;
            // $this.prop("disabled", true);

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
                    if (response.status == 500) {
                        toastr.error("Đã có lỗi xảy ra");
                    } else {
                        let errors = response.responseJSON.errors;
                        for (feild in errors) {
                            let feildHtml = feild.replace('.','');
                            $(`#error-${feildHtml}`).text(errors[feild]);
                            if(feild.includes('.')) {
                                $(`#error-${feildHtml}`).siblings(`input`).addClass("is-invalid");
                            } else {
                                $(`[name="${feildHtml}"]`).addClass("is-invalid");

                            }
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

    let imagePreview;
    $(document).on(
        "change",
        '.input-file-container input[type="file"]',
        function () {
            let file = this.files[0];
            imagePreview = URL.createObjectURL(file);
            $(".input-file-container").hide();
            $(".image_preview img").attr("src", imagePreview);
            $(".image_preview").show();
        }
    );
    $(document).on("click", ".image_preview i", function () {
        $('.input-file-container input[type="file"]').val("");
        $(".input-file-container").show();
        $(".image_preview").hide();
        $(".image_preview img").attr("src", "");
        $("#image_old").val("");
        URL.revokeObjectURL(imagePreview);
    });

    $(document).on("keypress", "input[type='tel']", function (event) {
        var character = String.fromCharCode(event.keyCode);
        return /[0-9\s]/.test(character);
    });
});
