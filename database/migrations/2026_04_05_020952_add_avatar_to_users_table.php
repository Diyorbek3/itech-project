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
        Schema::table('users', function (Blueprint $table) {
            // Mana shu yerga avatar ustunini qo'shamiz
            // nullable() - rasm bo'lmasa ham xato bermasligi uchun
            $table->string('avatar')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Migratsiyani orqaga qaytarganda ustunni o'chirib tashlaymiz
            $table->dropColumn('avatar');
        });
    }
};