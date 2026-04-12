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
    Schema::create('master_classes', function (Blueprint $table) {
        $table->id();
        $table->string('title');          // Master-class nomi
        $table->text('description');      // Batafsil ma'lumot
        $table->string('image');          // Rasm fayli yo'li
        $table->string('event_date');     // Masalan: "19-aprel, 16:00"
        $table->string('speaker_name')->nullable(); // Ma'ruzachi ismi
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_classes');
    }
};
