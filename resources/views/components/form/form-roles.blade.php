
<div class="form-group">
    <label>Tên chức vụ</label>
    <input type="text" class="form-control" name="name" value="{{ $data->name ?? '' }}"
        placeholder="Nhập tên chức vụ">
    <span id="error-name" class="text-danger font-italic error-alert"></span>
</div>
<div style="grid-column: 1 / span 3;">
    <h6>Phân quyền chức năng</h6>
    <div>@php
        dd(route()->all())
    @endphp</div>
</div>