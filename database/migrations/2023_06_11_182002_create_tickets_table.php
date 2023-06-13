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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(false);
            $table->string('ticket_number', 50)->nullable(false);
            $table->string('name', 60)->nullable(false);
            $table->string('surname', 60)->nullable(false);
            $table->string('email', 100)->nullable(false);
            $table->string('phone_number', 14)->nullable(false);
            $table->string('ip_address', 20)->nullable(false);
            $table->string('ticket_subject', 80)->nullable(false);
            $table->integer('category_id')->nullable();
            $table->integer('status_id')->default(1);
            $table->text('ticket_description')->nullable(false);
            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
