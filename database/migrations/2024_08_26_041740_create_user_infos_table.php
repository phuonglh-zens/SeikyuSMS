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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('customer_number')->nullable();
            $table->string('customer_management_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_name_kana')->nullable();
            $table->string('phone_number')->nullable();
            $table->bigInteger('company_code')->nullable();
            $table->string('company_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
