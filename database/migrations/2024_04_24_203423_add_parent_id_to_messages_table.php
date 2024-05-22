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
        if (!Schema::hasTable('messages')) {
            Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('child_id')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->unsignedBigInteger('content_id')->nullable(); // Corrected to content_id
                $table->enum('status', ['sent', 'delivered', 'read'])->default('sent');                
                $table->timestamps();
                $table->foreign('child_id')->references('id')->on('child_users')->onDelete('cascade');
                $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('content_id')->references('id')->on('categories')->onDelete('cascade');

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
