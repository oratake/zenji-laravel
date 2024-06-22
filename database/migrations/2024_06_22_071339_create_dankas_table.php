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
        Schema::create('dankas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('family_head_last_name')->comment('代表者 姓');
            $table->string('family_head_first_name')->comment('代表者 名');
            $table->string('family_head_last_name_kana')->comment('代表者 せい');
            $table->string('family_head_first_name_kana')->comment('代表者 めい');
            $table->string('email')->nullable()->unique()->comment('連絡用メールアドレス');
            $table->string('postcode')->comment('郵便番号');
            $table->string('address')->comment('住所');
            $table->string('phone_number')->nullable()->comment('電話番号');
            $table->text('note')->nullable()->comment('備考');
            $table->unsignedBigInteger('bouzu_id')->comment('登録したお坊さんuserのid');
            $table->foreign('bouzu_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dankas');
    }
};
