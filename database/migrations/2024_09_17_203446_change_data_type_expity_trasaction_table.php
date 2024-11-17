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
        //

        Schema::table('transaction_detail', function (Blueprint $table) {
            $table->string('card_expiry')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //

        Schema::table('transaction_detail', function (Blueprint $table) {
            $table->date('card_expiry')->change();
        });
    }
};
