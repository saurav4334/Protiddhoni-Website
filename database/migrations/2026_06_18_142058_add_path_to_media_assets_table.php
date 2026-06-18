<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('media_assets', function (Blueprint $table) {
            $table->string('path')->nullable()->after('title');   // relative path on the public disk
            $table->string('mime_type')->nullable()->after('path');
        });
    }

    public function down(): void
    {
        Schema::table('media_assets', function (Blueprint $table) {
            $table->dropColumn(['path', 'mime_type']);
        });
    }
};
