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
        Schema::table('dankas', function (Blueprint $table) {
            //郵便番号と住所をnullableに
            $table->string('postcode')->nullable()->comment('郵便番号')->change();
            $table->string('address')->nullable()->comment('住所')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dankas', function (Blueprint $table) {
            //郵便番号と住所のnullを不可に
            $table->string('postcode')->nullable(false)->comment('郵便番号')->change();
            $table->string('address')->nullable(false)->comment('住所')->change();
        });
    }
};
