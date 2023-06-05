<?php

use App\Models\CategoryAssets;
use App\Models\Order;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\TypeAssets;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

return [
    'config' => [
        'category_assets' => [
            'model' => CategoryAssets::class,
            'title' => 'Loại tài sản',
            'form_data' => 'form-category-assets'
        ],
        'type_assets' => [
            'model' => TypeAssets::class,
            'title' => 'Chủng loại tài sản',
            'form_data' => 'form-type-assets',
            'selectFeilds' => [
                'categoryAssets' => function() {
                    return CategoryAssets::latest()->get();
                },
                'years' => getYears()
            ]
        ],
        'suppliers' => [
            'model' => Supplier::class,
            'title' => 'Nhà cung cấp',
            'form_data' => 'form-suppliers',
        ],
        'orders' => [
            'model' => Order::class,
            'title' => 'Đơn đặt hàng',
            'form_data' => 'form-order',
            'selectFeilds' => [
                'categoryAssets' => function() {
                    return Cache::get('category_assets_list', function() {
                        $categoryAssets = CategoryAssets::latest()->get();
                        Cache::put('category_assets_list', $categoryAssets);
                        return CategoryAssets::latest()->get();
                    });
                },
                'suppliers' => function() {
                    return Cache::get('suppliers_list', function() {
                        $suppliers = Supplier::latest()->get();
                        Cache::put('suppliers_list', $suppliers);
                        return Supplier::latest()->get();
                    });
                },
                'payment_methods' => config('params.paymentmethods')
            ],
            'grid' => 'three-row'
        ],
        'users' => [
            'model' => User::class,
            'title' => 'Người dùng',
            'form_data' => 'form-users',
        ],
        'roles' => [
            'model' => Role::class,
            'title' => 'Chức vụ',
            'form_data' => 'form-roles'
        ],
    ]
];

?>
