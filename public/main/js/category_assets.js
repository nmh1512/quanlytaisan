$(document).ready(function () {
    let isRequest = false;

    $(document).on('keyup', 'input', function () {
        $(this).removeClass('is-invalid');
        $(this).siblings('.error-alert').empty()
    })
    $('#modalCenter').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var modalTitle = button.attr('title');
        var nameEdit = button.parents('tr').children('td:nth-child(2)').text()
        var urlRequest = button.data('href');

        var modal = $(this);
        modal.find('#submit').attr('data-href', urlRequest)
        modal.find('span.title').text(modalTitle);
        modal.find('#category_asset_name').val(nameEdit)
        
    });
    $(document).on("click", "#submit", function (e) {
        e.preventDefault();
        if (!isRequest) {
            let $this = $(this);
            isRequest = true
            $this.prop("disabled", true);

            let categotyAssetName = $("#category_asset_name").val();
            let urlRequest = $this.data("href");
            let csrfToken = $('meta[name="csrf-token"]').attr("content");
            // lay attr url dc truyen vao the script
            $.ajax({
                type: "POST",
                data: {
                    category_asset_name: categotyAssetName,
                    _token: csrfToken,
                },
                headers: {
                    "X-CSRF-TOKEN": csrfToken, // Gửi mã thông báo CSRF trong header của request
                },
                url: urlRequest,
                success: function (response) {
                    if (response.status == "success") {
                        toastr.success("Thêm loại tài sản thành công.");
                        $('#modalCenter').modal('hide')
                        $('#table-category-assets').html(response.table)
                        $("#category_asset_name").val('');
                        $('span.title').empty();
                        $('.is-invalid').removeClass('is-invalid')
                    } 
                },
                error: function (response) {
                    if(response.status == "error"){
                        toastr.error("Đã có lỗi xảy ra");
                    } else {
                        $('#error-name').text(response.responseJSON.message)
                        $('#category_asset_name').addClass('is-invalid')
                    }
                },
                complete: function() {
                    isRequest = false
                    $this.removeAttr('disabled')
                }
            });
        }
    });

});
