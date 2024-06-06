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
            //各カラムにコメントを追加
            $table->string('name')->comment('僧名')->change();
            $table->string('email')->comment('メールアドレス')->change();
            $table->string('password')->comment('パスワード')->change();
            $table->string('jiin_name')->comment('寺院名')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //各カラムのコメントを削除
            $table->string('name')->comment(null)->change();
            $table->string('email')->comment(null)->change();
            $table->string('password')->comment(null)->change();
            $table->string('jiin_name')->comment(null)->change();
        });
    }
};
