<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now()->format('Y-m-d H:i:s');
        DB::table('roles')->insert(
            [
                ['name' => 'Tổng Giám đốc', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Trưởng phòng kỹ thuật', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Quản lý kho', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Developer C#', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Nhân viên kinh doanh', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Kế toán', 'created_at' => $now, 'updated_at' => $now],
            ]
        );
    }
}
