<?php

use App\Models\CategoryAssets;
use App\Models\Supplier;
use App\Models\TypeAssets;
use App\View\Components\FormCategoryAssets;
use App\View\Components\FormSuppliers;
use App\View\Components\FormTypeAssets;

return [
    'config' => [
        'category_assets' => [
            'model' => CategoryAssets::class,
            'title' => 'Loại tài sản',
            'form_data' => FormCategoryAssets::class
        ],
        'type_assets' => [
            'model' => TypeAssets::class,
            'title' => 'Chủng loại tài sản',
            'form_data' => FormTypeAssets::class,
        ],
        'suppliers' => [
            'model' => Supplier::class,
            'title' => 'Nhà cung cấp',
            'form_data' => FormSuppliers::class,
        ]
    ]
];

?>
