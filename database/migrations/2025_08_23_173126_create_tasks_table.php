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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();  // Primary Key, Auto Increment
            $table->string('title');  // string for title
            $table->text('description')->nullable();  // text, optional (nullable)
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');  // enum with default
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // foreign key to users table
            $table->timestamps();  // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
