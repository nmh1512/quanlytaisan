<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'category assets view']);
        Permission::create(['name' => 'category assets create']);
        Permission::create(['name' => 'category assets edit']);
        Permission::create(['name' => 'category assets delete']);

        Permission::create(['name' => 'type assets view']);
        Permission::create(['name' => 'type assets create']);
        Permission::create(['name' => 'type assets edit']);
        Permission::create(['name' => 'type assets delete']);

        Permission::create(['name' => 'suppliers view']); 
        Permission::create(['name' => 'suppliers create']); 
        Permission::create(['name' => 'suppliers edit']); 
        Permission::create(['name' => 'suppliers delete']); 

        Permission::create(['name' => 'orders view']); 
        Permission::create(['name' => 'orders create']); 
        Permission::create(['name' => 'orders edit']); 
        Permission::create(['name' => 'orders delete']); 

        Permission::create(['name' => 'users view']); 
        Permission::create(['name' => 'users create']); 
        Permission::create(['name' => 'users edit']); 
        Permission::create(['name' => 'users delete']); 

        Permission::create(['name' => 'permissions view']); 
        Permission::create(['name' => 'permissions create']); 
        Permission::create(['name' => 'permissions edit']); 
        Permission::create(['name' => 'permissions delete']); 

        Permission::create(['name' => 'roles view']); 
        Permission::create(['name' => 'roles create']); 
        Permission::create(['name' => 'roles edit']); 
        Permission::create(['name' => 'roles delete']); 

        Role::create(['name' => 'Tổng giám đốc']);
        Role::create(['name' => 'Trưởng phòng Kỹ thuật']);
        Role::create(['name' => 'Nhân viên kinh doanh']);
        Role::create(['name' => 'Lập trình viên']);
        Role::create(['name' => 'HR']);
        Role::create(['name' => 'Quản lý nhân sự']);

    }
}
