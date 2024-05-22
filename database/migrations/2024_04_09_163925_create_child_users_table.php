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
        Schema::create('child_users', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable(); // Makes the email column unique
            $table->string('password')->nullable();
            $table->string('status')->nullable();
            $table->date('birthday')->nullable();
            $table->date('reminder_date')->nullable(); // Nullable if the reminder is optional
            $table->boolean('send_status')->nullable();
            $table->string('cover_photo')->nullable(); // Nullable if the cover photo is optional
            $table->string('profile')->nullable(); // Nullable if the profile is optional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_users');
    }
};
