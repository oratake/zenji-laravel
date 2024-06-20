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
            //jiin_nameをnullableに変更
            $table->string('jiin_name')->nullable(true)->comment('寺院名')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //jiin_nameはnullを不可にする
            $table->string('jiin_name')->nullable(false)->comment('寺院名')->change();
        });
    }
};
