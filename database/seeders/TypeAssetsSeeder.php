<?php

namespace Database\Seeders;

use App\Models\TypeAssets;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeAssetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TypeAssets::factory(100)->create();
    }
}
