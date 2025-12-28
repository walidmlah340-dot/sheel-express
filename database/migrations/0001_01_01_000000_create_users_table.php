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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();

            // 👇 رقم الموبايل بدل الإيميل
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();

            // 👇 نخليه nullable عشان OTP
            $table->string('password')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        // ❌ هنلغي password_reset_tokens (مش محتاجينه مع OTP)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
