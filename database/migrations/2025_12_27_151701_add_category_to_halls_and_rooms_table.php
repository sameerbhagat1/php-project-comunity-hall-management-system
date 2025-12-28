<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('community_halls', function (Blueprint $table) {
            $table->string('category')->default('General')->after('name');
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->string('category')->default('Standard')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_halls', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
