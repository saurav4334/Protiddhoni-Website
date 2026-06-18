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
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('price_monthly')->nullable();   // Taka; null/0 = custom
            $table->unsignedInteger('price_yearly')->nullable();
            $table->string('rate_per_min')->nullable();             // string allows "Custom"
            $table->json('features')->nullable();                   // array of feature strings
            $table->string('cta_label')->nullable();
            $table->string('cta_url')->nullable();
            $table->string('badge')->nullable();                    // e.g. "Most Popular"
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
