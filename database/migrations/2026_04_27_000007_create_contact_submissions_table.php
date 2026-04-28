<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->enum('interest', ['voice_otp', 'voice_survey', 'voice_broadcast', 'other'])->default('other');
            $table->string('name');
            $table->string('email')->index();
            $table->string('company')->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('industry', 64)->nullable();
            $table->string('expected_volume', 64)->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'in_review', 'replied', 'qualified', 'archived'])->default('new');
            $table->foreignId('assigned_to')->nullable()->constrained('admins')->nullOnDelete();
            $table->text('internal_notes')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent', 512)->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};
