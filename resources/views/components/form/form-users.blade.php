<div class="form-group">
    <label>Tên người dùng</label>
    <input type="text" class="form-control" name="name"
        placeholder="Nhập tên người dùng" value="{{ $data->name ?? '' }}">
    <span id="error-name" class="text-danger font-italic error-alert"></span>
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="email"
        placeholder="Nhập email" value="{{ $data->email ?? '' }}">
    <span id="error-email" class="text-danger font-italic error-alert"></span>
</div>