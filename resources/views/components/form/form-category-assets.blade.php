
    <div class="form-group">
        <label>Tên loại tài sản</label>
        <input type="text" class="form-control" name="name" value="{{ $data->name ?? '' }}"
            placeholder="Nhập tên loại tài sản">
        <span id="error-name" class="text-danger font-italic error-alert"></span>
    </div>