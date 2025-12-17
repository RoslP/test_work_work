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
        Schema::table('photos', function (Blueprint $table) {
            $table->string('original_path')->nullable();
            $table->string('path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->string('error_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('original_path');
            $table->dropColumn('path');
            $table->dropColumn('thumbnail_path');
            $table->dropColumn('status');
            $table->dropColumn('processed_at');
            $table->dropColumn('error_message');
        });
    }
};
