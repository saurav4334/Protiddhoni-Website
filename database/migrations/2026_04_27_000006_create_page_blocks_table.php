<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * page_blocks holds editable content for the marketing site —
     * homepage hero, FAQ items, testimonials, pricing tiers, team, etc.
     * Each block is keyed (e.g. "homepage.hero.title", "homepage.testimonials")
     * and stores either a string value or a JSON payload.
     */
    public function up(): void
    {
        Schema::create('page_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();                  // homepage.hero.headline
            $table->string('label');                          // Human-readable name in CMS
            $table->string('page', 64)->index();              // homepage, voice-otp, pricing, ...
            $table->enum('type', ['text', 'rich_text', 'json', 'image', 'boolean', 'integer'])->default('text');
            $table->longText('value')->nullable();            // raw value (string or JSON)
            $table->text('description')->nullable();          // editor hint
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_blocks');
    }
};
