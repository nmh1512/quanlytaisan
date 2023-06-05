<?php

namespace App\Console\Commands;

use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateAssetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-asset-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        DB::table('type_assets')->insert([
            'name' => fake()->firstName(),
            'category_asset_id' => rand(1,100),
            'model' => Str::random(32),
            'brand' => fake()->company(),
            'year_create' => fake()->year(),
            'unit' => fake()->lastName(),
            'image' => fake()->image(),
            'user_create' => rand(0,100),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
