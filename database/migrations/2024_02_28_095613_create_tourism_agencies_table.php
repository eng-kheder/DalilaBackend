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
        Schema::create('tourism_agencies', function (Blueprint $table) {
            $table->id();
            $table->char('name', 50)->nullable(false);
            $table->char('city', 50)->nullable(false);
            $table->char('phone_number', 50)->nullable(false)->unique();
            $table->char('email', 50)->nullable(false)->unique();
            $table->char('location_agency', 50)->nullable(false);
            $table->char('commercial_record_agency', 50)->nullable(false)->unique();
            $table->unsignedBigInteger('type_id')->nullable()->default(0);
            $table->double('price_agency')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('language_agency')->nullable(false);
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
        Schema::dropIfExists('tourism_agencies');
    }
};
