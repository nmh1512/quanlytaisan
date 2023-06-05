<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_assets', function (Blueprint $table) {
            //
            $table->bigInteger('price')->after('type_asset_id');
            $table->integer('quantity')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_assets', function (Blueprint $table) {
            //
        });
    }
};
