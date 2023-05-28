<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên loại tài sản</th>
            <th>Người tạo</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($categoryAssetsList))
            @foreach ($categoryAssetsList as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->userCreated->name }}</td>
                    <td>{{ $item->formatted_created_at }}</td>
                    <td>
                        <button data-href="{{ route('category_assets_edit', ['id' => $item->id]) }}" title="Sửa" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCenter">
                            <i class="far fas fa-edit"></i>
                        </button>
                        |
                        <button title="Xóa" type="button" class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<div class="mt-3 d-flex justify-content-center">
    {!! $categoryAssetsList->links() !!}
</div>
