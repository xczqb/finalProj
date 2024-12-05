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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('company_name'); // Business name
            $table->string('owner_name'); // Owner's name
            $table->string('email')->unique(); // Email
            $table->string('phone'); // Phone number
            $table->string('company_type'); // Business type (e.g., Hotel, Resort)
            $table->string('province'); // Province (stored as code)
            $table->string('city'); // City (stored as code)
            $table->text('description')->nullable(); // Business description (optional)
            $table->string('company_registration'); // Path to uploaded business registration file
            $table->string('owner_id'); // Path to uploaded owner ID file
            $table->boolean('is_verified')->default(false); // Admin approval flag
            $table->string('password'); // Password
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
