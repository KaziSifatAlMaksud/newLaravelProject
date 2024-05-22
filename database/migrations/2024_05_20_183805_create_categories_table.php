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
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('file')->nullable();
                $table->string('file_type', 10)->nullable(); 
                $table->unsignedBigInteger('child_id')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable(); 
                $table->boolean('status')->default(true);
                $table->timestamps();
                $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('child_id')->references('id')->on('child_users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
