$(function() {
    $(document).on('change', '.select-roles', function () {
        let $this = $(this)
        let roleId = $this.val()
        if(roleId == null) return false

        let csrfToken = $('meta[name="csrf-token"]').attr("content");
        let userId = $this.attr('data-id')
        $.ajax({
            type: 'POST',
            url: route('home.set-role', userId),
            data: {
                role_id: roleId
            },
            headers: {
                "X-CSRF-TOKEN": csrfToken, // Gửi mã thông báo CSRF trong header của request
            },
            success: function(response) {
                if (response.status == "success") {
                    toastr.success('Cập nhật chức vụ thành công');
                }
            },
            error: function() {
                toastr.error("Đã có lỗi xảy ra");
                $this.select2('val','0')
            }
        })
    })
})