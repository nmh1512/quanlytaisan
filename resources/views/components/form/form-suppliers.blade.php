    <div class="form-group">
        <label>Tên nhà cung cấp <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" value="{{ $data->name ?? '' }}"
            placeholder="Nhập tên nhà cung cấp">
        <span id="error-name" class="text-danger font-italic error-alert"></span>
    </div>
    
    <div class="form-group">
        <label>Địa chỉ</label>
        <input type="text" class="form-control" name="address" value="{{ $data->address ?? '' }}"
            placeholder="Nhập địa chỉ">
    </div>
    
    <div class="form-group">
        <label>Số điện thoại</label>
        <input type="tel" class="form-control" name="phone" value="{{ $data->phone ?? '' }}"
            placeholder="Nhập số điện thoại">
    </div>

    <div class="form-group">
        <label>Mã số thuế</label>
        <input type="tel" class="form-control" name="tax_code" value="{{ $data->tax_code ?? '' }}"
            placeholder="Nhập mã số thuế">
    </div>

    <div class="form-group">
        <label>Người đại diện</label>
        <input type="text" class="form-control" name="representative" value="{{ $data->representative ?? '' }}"
            placeholder="Nhập tên người đại diện">
    </div>
