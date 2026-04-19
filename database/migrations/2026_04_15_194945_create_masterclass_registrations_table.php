<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masterclass_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masterclass_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->boolean('telegram_sent')->default(false);
            $table->string('status')->default('pending');
            $table->timestamps();
            
            // Foreign keys (agar kerak bo'lsa)
            // $table->foreign('masterclass_id')->references('id')->on('master_classes')->onDelete('set null');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masterclass_registrations');
    }
};