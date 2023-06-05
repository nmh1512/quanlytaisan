    <div class="form-group">
        <label>Tên chủng loại tài sản <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" value="{{ $data->name ?? '' }}"
            placeholder="Nhập tên chủng loại tài sản">
        <span id="error-name" class="text-danger font-italic error-alert"></span>
    </div>
    <div class="form-group">
        <label for="category_asset_id">Loại tài sản <span class="text-danger">*</span></label>
        <select class="form-control" id="category-asset" name="category_asset_id" data-placeholder="Chọn loại tài sản">
            <option></option>
            @foreach ($selects['categoryAssets']() as $item)
                <option {{ !empty($data) && $data->category_asset_id == $item->id ? 'selected' : '' }}
                    value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <span id="error-category_asset_id" class="text-danger font-italic error-alert"></span>
    </div>
    <div class="form-group">
        <label>Ký hiệu chủng loại</label>
        <input type="text" class="form-control" name="model" value="{{ $data->model ?? '' }}"
            placeholder="Nhập ký hiệu chủng loại">
    </div>
    <div class="form-group">
        <label>Hãng sản xuất <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="brand" value="{{ $data->brand ?? '' }}"
            placeholder="Nhập hãng sản xuất">
        <span id="error-brand" class="text-danger font-italic error-alert"></span>
    </div>
    <div class="form-group">
        <label for="year">Năm sản xuất <span class="text-danger">*</span></label>
        <select class="form-control" id="year" name="year" data-placeholder="Chọn năm sản xuất">
            <option></option>
            @foreach ($selects['years'] as $year)
                <option {{ !empty($data) && $data->year_create == $year ? 'selected' : '' }}
                    value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
        <span id="error-year" class="text-danger font-italic error-alert"></span>
    </div>
    <div class="form-group">
        <label>Đơn vị tính <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="unit" value="{{ $data->unit ?? '' }}"
            placeholder="Nhập đơn vị tính">
        <span id="error-unit" class="text-danger font-italic error-alert"></span>
    </div>

    <div class="form-group upload-btn-wrapper">
        <div class="image_preview" style="display: {{ !empty($data->image) ? 'block' : 'none' }}">
            <img src="{{ !empty($data) ? $data->image : '' }}" alt="Preview" class="w-100">
            <i role="button" class="far fa-times-circle" style="color: #ff0000"></i>
        </div>
        <div class="input-file-container" style="display: {{ !empty($data->image) ? 'none' : 'block' }}">
            <button class="btn">Thêm ảnh</button>
            <input type="file" class="form-control" name="image" />
        </div>
        <input id="image_old" type="hidden" name="image_old" value="{{ $data->image ?? '' }}">
    </div>
