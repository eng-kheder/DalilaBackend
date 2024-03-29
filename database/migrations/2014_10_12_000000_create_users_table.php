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
            $table->char('name', 50)->nullable(false);
            $table->char('city', 50)->nullable(false);
            $table->char('phone_number', 50)->nullable(false)->unique();
            $table->char('email', 50)->nullable(false)->unique();
            $table->boolean('gender_user')->default(false)->nullable(false);
            $table->integer('age_user')->nullable(false);
            $table->unsignedBigInteger('type_id')->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->char('password', 255)->nullable(false)->default("12345678");
            $table->char('password_confirmation', 255)->nullable(false)->default("12345678");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
