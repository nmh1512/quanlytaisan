$(function () {
    $(document).on("change", "#category_assets", function () {
        let categoryAssets = $(this).select2("data");
        let categoryAssetsId = $(this).val();
        let categoryAssetsText = categoryAssets[0].text;
        if (categoryAssetsId == "") {
            toastr.error("Đã có lỗi xảy ra");
            return false;
        }
        $.get(route("home.get-type-assets", categoryAssetsId)).done((response) => {
            let html = "";
            if (response.data.length == 0) {
                toastr.warning(
                    `Không có chủng loại nào thuộc loại tài sản ${categoryAssetsText}`
                );
            } else {
                $.each(response.data, (index, value) => {
                    html += `<option value="${value.id}" data-unit="${value.unit}">${value.name}</option>`;
                });
            }
            $("#type_assets").html(html).multiselect("rebuild");

            // check neu dang la chinh sua (danh sach tai san co data)
            if (!isEmpty($(".list_assets tbody"))) {
                let listAssets = [];
                $(".list_assets tbody tr").each(function () {
                    let idAssetChecked = $(this).attr("data-id");
                    listAssets.push(idAssetChecked); //day cac id trong bang vao listAssets
                });
                $("#type_assets").multiselect('select', listAssets); // selected cac asset trong multiselect assets
            }
            //
        });
    });

    $(document).on("click", "i.fa-times", function () {
        let tr = $(this).parents("tr");
        let idTr = tr.attr("data-id");
        tr.remove();
        //unselected gia tri da chon khi remove no khoi bang
        $("#type_assets").multiselect("deselect", idTr);

        // reset index cua attr name cua input price va quantity trong table
        $(".list_assets tbody tr").each(function (index) {
            $(this)
                .find('input[name="price[]"]')
                .siblings(".error-alert")
                .attr("id", "error-price" + index);
            $(this)
                .find('input[name="quantity[]"]')
                .siblings(".error-alert")
                .attr("id", "error-quantity" + index);
            $(this).children("td").first().text(++index);
        });
    });
});
