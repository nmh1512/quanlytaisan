$(function() {
    let isRequest = false;
    let modalTitle = "";
    let action;
    $("#modalCenter").on("show.bs.modal", function (event) {
        var currentRoute = route().current();
        var button = $(event.relatedTarget);
        modalTitle = button.attr("title");
        var id = button.attr("data-id"); // lay id cua ban ghi
        var urlRequest = button.attr("data-href"); 
        action = button.attr("data-action")
        
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
           
            $.get(route("home.form-data"), data)
                .done(function (response) {
                    modal.find(".modal-body").html(response.data);
                    if($('select.form-control').length) {
                        $("form select.form-control").select2({
                            theme: "bootstrap",
                        });
                    }
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

            let form;
            if($("#formData").length) {
                form = $("#formData")[0];
            }
            let formData = new FormData(form);

            if(action == 'reject' || action == 'accept') {
                formData.append('order_review', action);
            }
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
                    let table = $("#data-table").DataTable();
                    if (response.status == "success") {
                        if(route().current() == 'home.roles_index') {
                            window.location.reload();
                            return;
                        }
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
})