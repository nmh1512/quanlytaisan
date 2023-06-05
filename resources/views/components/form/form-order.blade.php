<div class="form-group">
    <label>Mã đơn hàng <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="code" value="{{ $data->code ?? '' }}" placeholder="Nhập mã đơn hàng">
    <span id="error-code" class="text-danger font-italic error-alert"></span>
</div>
<div class="form-group">
    <label for="supplier_id">Nhà cung cấp <span class="text-danger">*</span></label>
    <select class="form-control" id="supplier_id" name="supplier_id" data-placeholder="Chọn nhà cung cấp">
        <option></option>
        @foreach ($selects['suppliers']() as $item)
            <option {{ !empty($data) && $data->supplier_id == $item->id ? 'selected' : '' }}
                value="{{ $item->id }}">
                {{ $item->name }}</option>
        @endforeach
    </select>
    <span id="error-supplier_id" class="text-danger font-italic error-alert"></span>
</div>
<div class="form-group">
    <label>Ngày đặt hàng <span class="text-danger">*</span></label>
    <input type="date" class="form-control" name="order_date" value="{{ $data->order_date ?? '' }}">
    <span id="error-order_date" class="text-danger font-italic error-alert"></span>
</div>
<div class="form-group">
    <label>Ngày nhận hàng <span class="text-danger">*</span></label>
    <input type="date" class="form-control" name="delivery_date" value="{{ $data->delivery_date ?? '' }}">
    <span id="error-delivery_date" class="text-danger font-italic error-alert"></span>
</div>
<div class="form-group">
    <label>Địa chỉ nhận hàng</label>
    <input type="text" class="form-control" name="delivery_address" value="{{ $data->delivery_address ?? '' }}"
        placeholder="Nhập địa chỉ nhận hàng">
    <span id="error-delivery_address" class="text-danger font-italic error-alert"></span>
</div>
<div class="form-group">
    <label for="payment_methods">Phương thức thanh toán <span class="text-danger">*</span></label>
    <select class="form-control" id="payment_methods" name="payment_methods" data-minimum-results-for-search="Infinity"
        data-placeholder="Chọn phương thức thanh toán">
        <option></option>
        @foreach ($selects['payment_methods'] as $key => $item)
            <option {{ !empty($data) && $data->payment_methods == $key ? 'selected' : '' }} value="{{ $key }}">
                {{ $item }}</option>
        @endforeach
    </select>
    <span id="error-payment_methods" class="text-danger font-italic error-alert"></span>
</div>
<div style="grid-column: 1 / span 3;">
    <h6>Chi tiết đơn hàng</h6>
    <div class="order_detail">
        <div class="select_asset">
            <div class="form-group">
                <label for="category_assets">Loại tài sản</label>
                <select class="form-control" id="category_assets" data-placeholder="Chọn loại tài sản">
                    <option></option>
                    @foreach ($selects['categoryAssets']() as $item)
                        <option value="{{ $item->id }}"> {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="type_assets">Chủng loại tài sản</label>
                <select id="type_assets" multiple="multiple" data-placeholder="Chọn chủng loại tài sản">
                </select>
            </div>
        </div>
        <label class="w-100">Danh sách chủng loại tài sản</label>
        <span id="error-type_asset_id" class="text-danger font-italic error-alert"></span>
        <table class="list_assets table table-bordered">
            <thead>
                <th>#</th>
                <th>Tên chủng loại</th>
                <th>Loại tài sản</th>
                <th>Đơn vị tính</th>
                <th>Đơn giá (VNĐ)</th>
                <th>Số lượng</th>
                <th width="20px">Xóa</th>
            </thead>
            <tbody>
                @if (isset($data) && $data->typeAssetsInOrder()->exists())
                    @foreach ($data->typeAssetsInOrder as $id => $typeAsset)
                        <tr data-id="{{ $typeAsset->id }}">
                            <td>{{ $id + 1 }}</td>
                            <td>{{ $typeAsset->name }}
                                <input type="hidden" name="type_asset_id[]" value="{{ $typeAsset->id }}" />
                            </td>
                            <td>{{ $typeAsset->categoryAsset->name }}</td>
                            <td>{{ $typeAsset->unit }}</td>
                            <td><input 
                                    type="tel" 
                                    name="price[]" 
                                    class="form-control" 
                                    placeholder="Nhập đơn giá" 
                                    value="{{ $typeAsset->pivot->price }}" />
                                <span id="error-price{{$id}}" class="text-danger font-italic error-alert"></span>
                            </td>
                            <td><input 
                                    type="tel" 
                                    name="quantity[]" 
                                    class="form-control"
                                    placeholder="Nhập số lượng"
                                    value="{{ $typeAsset->pivot->quantity }}" />
                                <span id="error-quantity{{$id}}" class="text-danger font-italic error-alert"></span>
                            </td>
                            <td class="text-center"><i id="{{ $typeAsset->id }}" class="fas fa-times"></i></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
