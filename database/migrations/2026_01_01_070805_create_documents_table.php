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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('file_path');
            $table->enum('file_type', ['pdf', 'image']);
            $table->enum('document_type', [
                'certificate',
                'manual',
                'catalogue',
                'conversion_chart',
                'other'
            ]);
            $table->enum('status', ['Active', 'Draft'])->default('Active');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
