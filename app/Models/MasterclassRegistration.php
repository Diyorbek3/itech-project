<?php
Schema::create('masterclass_registrations', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('masterclass_id');
    $table->string('name');
    $table->string('phone');
    $table->string('email')->nullable();
    $table->timestamps();
    
    $table->foreign('masterclass_id')->references('id')->on('master_classes')->onDelete('cascade');
});