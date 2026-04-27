<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('my_tests')) {
            Schema::create('my_tests', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('category');
                $table->integer('questions');
                $table->integer('time');
                $table->integer('participants')->default(0);
                $table->enum('status', ['active', 'pending', 'archived'])->default('active');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('my_tests');
    }
};