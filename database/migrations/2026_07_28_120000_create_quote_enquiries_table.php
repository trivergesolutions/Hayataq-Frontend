<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Homepage "Request a Quote" enquiry form.
     */
    public function up(): void
    {
        Schema::create('quote_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('category')->nullable(); // Interested in
            $table->string('industry')->nullable();
            $table->text('project_requirement');
            $table->string('status')->default('New'); // New, Read, Replied
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_enquiries');
    }
};
