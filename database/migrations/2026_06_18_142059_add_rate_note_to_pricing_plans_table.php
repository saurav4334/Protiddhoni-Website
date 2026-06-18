<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->string('rate_note')->nullable()->after('rate_per_min'); // e.g. "+ ৳0.50 per minute · Pay as you go"
        });
    }

    public function down(): void
    {
        Schema::table('pricing_plans', function (Blueprint $table) {
            $table->dropColumn('rate_note');
        });
    }
};
