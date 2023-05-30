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
        Schema::table('type_assets', function (Blueprint $table) {
            //
            $table->string('model')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->string('image_origin_name')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_assets', function (Blueprint $table) {
            //
        });
    }
};
