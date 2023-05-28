<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><span class="title"></span> danh mục loại tài sản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" class="form-control" id="category_asset_name"
                            placeholder="Nhập tên danh mục">
                        <span id="error-name" class="text-danger font-italic error-alert"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-href="" type="button" id="submit" type="button" class="btn btn-primary"><span class="title"></span></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
