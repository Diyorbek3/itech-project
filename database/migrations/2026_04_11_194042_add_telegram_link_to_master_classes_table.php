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
        if (Schema::hasTable('master_classes')) {
            Schema::table('master_classes', function (Blueprint $table) {
                // Avval tekshiramiz, agar ustun bo'lmasa keyin qo'shamiz
                if (!Schema::hasColumn('master_classes', 'telegram_link')) {
                    $table->string('telegram_link')->nullable()->after('description');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_classes', function (Blueprint $table) {
            if (Schema::hasColumn('master_classes', 'telegram_link')) {
                $table->dropColumn('telegram_link');
            }
        });
    }
};