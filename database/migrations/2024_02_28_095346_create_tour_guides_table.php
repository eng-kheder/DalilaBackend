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
        Schema::create('tour_guides', function (Blueprint $table) {
            $table->id();
            $table->char('name', 50)->nullable(false);
            $table->char('city', 50)->nullable(false);
            $table->char('phone_number', 50)->nullable(false)->unique();
            $table->char('email', 50)->nullable(false)->unique();
            $table->boolean('gender_guide')->default(false)->nullable(false);
            $table->integer('age_guide')->nullable(false);
            $table->unsignedBigInteger('type_id')->nullable()->default(0);
            $table->double('price_guide')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('language_guide')->nullable(false);
            $table->char('password', 255)->nullable(false)->default("12345678");
            $table->char('password_confirmation', 255)->nullable(false)->default("12345678");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_guides');
    }
};
