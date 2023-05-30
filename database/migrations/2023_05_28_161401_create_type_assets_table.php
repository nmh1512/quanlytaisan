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
        Schema::create('type_assets', function (Blueprint $table) {
            $table->id();
            $table->integer('category_asset_id');
            $table->string('name');
            $table->string('model');
            $table->string('brand');
            $table->string('year_create');
            $table->string('unit');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_assets');
    }
};
