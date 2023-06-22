@php
    use \Illuminate\Support\Str;   
@endphp
<div class="form-group" style="grid-column: 1 / span 3;">
    <label>Tên chức vụ</label>
    <input type="text" class="form-control" name="name" value="{{ $data->name ?? '' }}"
        placeholder="Nhập tên chức vụ">
    <span id="error-name" class="text-danger font-italic error-alert"></span>
</div>
<div style="grid-column: 1 / span 3;">
    <h6 class="font-weight-bold">Phân quyền chức năng</h6>
        @foreach (config('routetitle.config') as $key => $item)
            <div>
                <p class="mb-2 font-weight-bold">{{ $item['title'] }}</p>
                @php
                    $moduleName = trim(Str::replace(['home.', '_index'], ['',' '], $key));
                @endphp
                <div class="grid-4-cols">
                    @foreach (getRoutesByStarting('home.') as $routeName => $value)
                        
                        @if (Str::contains($routeName, $moduleName) && Str::contains($routeName, ['index', 'create', 'edit', 'delete', 'disable', 'setRole', 'review']))
                            @php
                                $value = Str::replace(['home.', '_', 'index'], ['',' ', 'view'], $routeName);
                                $actions = config('params.actions')[trim(Str::replace(['home.', $moduleName, '_'], ['','',''], $routeName))];
                            @endphp
                            <div>
                                <label class="font-weight-normal" role="button" for="{{ $routeName }}">{{ $actions }}</label>
                                <input @if (!empty($data->permissions) && $data->permissions->contains('name', $value))
                                    {{'checked'}}
                                @endif type="checkbox" name="permissions[]" id="{{ $routeName }}" value="{{ $value }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

        
</div>