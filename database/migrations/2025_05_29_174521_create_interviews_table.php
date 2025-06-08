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
        Schema::create('interviews', function (Blueprint $table) {
              $table->id();
              $table->foreignId('job_application_id')->constrained()->onDelete('cascade');
              $table->dateTime('scheduled_at');
             $table->string('slug')->unique();
              $table->date('remind_me');
              $table->string('location');
              $table->boolean('reminder_sent')->default(false);
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
