$(document).ready(function () {
    let columnsData = {
        "home.category_assets_index": [
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
        "home.type_assets_index": [
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
        "home.suppliers_index": [
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
        "home.orders_index": [
            {
                data: "id",
                name: "id",
            },
            {
                data: null,
                name: "code",
                render: function(data) {
                    return `<a class="font-weight-bold" href="${ route('home.order_detail', data.id) }">${data.code}</a>`
                }
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
        "home.users_index": [
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
                data: null,
                name: "",
                orderable: false,
                searchable: false,
                render: function(data) {
                    var container = $("<div></div>");
                    return container.html(data.select_role).text();
                }
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
                    if(data.status == 'INACTIVE') {
                        color = 'danger';
                        text = 'Vô hiệu hóa';
                    }
                    return `
                        <p class="text-${color}">${text}</p>
                    `;
                },
            },
        ],
        "home.roles_index": [
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
        ajax: {
            type: 'GET',
            url: route(currentRoute),
            complete: function () {
                $('.select-roles').select2({
                    theme: "bootstrap",
                    width: '100%'
                    
                });
            }    
        },
        columns: [
            ...columnsData[currentRoute],
            {
                data: null,
                orderable: false,
                searchable: false,
                responsivePriority: 1,
                defaultContent: "",
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

    $(document).on("keyup", "input", function () {
        $(this).removeClass("is-invalid");
        $(this).siblings(".error-alert").empty();
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
