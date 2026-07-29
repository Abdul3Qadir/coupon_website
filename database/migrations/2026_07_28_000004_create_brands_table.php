<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('small_logo')->nullable();
            $table->string('large_logo')->nullable();
            $table->string('website_url');
            $table->json('social_links')->nullable();
            $table->string('short_description');
            $table->longText('about_description')->nullable();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('status')->default('pending');
            $table->string('rejection_reason')->nullable();
            $table->boolean('allow_admin_to_add_offers')->default(false);
            $table->boolean('auto_publish_offers')->default(false);
            $table->foreignId('verified_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
