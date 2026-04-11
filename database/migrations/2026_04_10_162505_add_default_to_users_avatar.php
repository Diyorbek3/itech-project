<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1-QADAM: Avval eski NULL bo'lib turgan hamma avatarlarni 'default.png' qilib chiqamiz
        DB::table('users')->whereNull('avatar')->update(['avatar' => 'default.png']);

        // 2-QADAM: Keyin ustunni NOT NULL va DEFAULT qilamiz
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->default('default.png')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->default(null)->nullable(true)->change();
        });
    }
};