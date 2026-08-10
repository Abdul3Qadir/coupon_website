<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('feature_image');
            $table->string('image_title')->nullable()->after('image_alt');
            $table->string('image_caption')->nullable()->after('image_title');
            $table->text('image_description')->nullable()->after('image_caption');
            $table->string('focus_keyword')->nullable()->after('content');
            $table->string('seo_title')->nullable()->after('focus_keyword');
            $table->text('seo_description')->nullable()->after('seo_title');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['image_alt', 'image_title', 'image_caption', 'image_description', 'focus_keyword', 'seo_title', 'seo_description']);
        });
    }
};
