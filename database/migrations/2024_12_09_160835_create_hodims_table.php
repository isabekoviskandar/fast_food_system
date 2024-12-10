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
        Schema::create('hodims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('bolim_id')->constrained('bolims')->onDelete('cascade');
            $table->string('oylik_type');
            $table->integer('oylik_miqdori');
            $table->integer('bonus');
            $table->integer('oylik_time');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hodims');
    }
};
