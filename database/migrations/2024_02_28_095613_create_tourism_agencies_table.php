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
            $table->char('agency_name', 50)->nullable(false);
            $table->char('city', 50)->nullable(false);
            $table->char('phone_number', 50)->nullable(false)->unique();
            $table->char('email', 50)->nullable(false)->unique();
            $table->char('location', 50)->nullable(false);
            $table->char('commercial_record', 50)->nullable(false)->unique();
            $table->unsignedBigInteger('type_id')->nullable(false);
            $table->double('price')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->char('password', 50)->nullable(false);
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
