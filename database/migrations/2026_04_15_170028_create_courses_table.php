<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('duration')->nullable();
            $table->integer('student_count')->default(0);
            $table->boolean('has_certificate')->default(true);
            $table->string('word_link')->nullable();
            $table->string('excel_link')->nullable();
            $table->string('powerpoint_link')->nullable();
            $table->string('archive_link')->nullable();
            $table->string('document_link')->nullable();
            $table->text('curriculum')->nullable();
            $table->text('target_audience')->nullable();
            $table->string('teachers')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('start_in')->nullable();
            $table->string('schedule')->nullable();
            $table->string('language')->nullable();
            $table->boolean('has_mentor_support')->default(false);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};