<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_verification_codes', function (Blueprint $table) {
            $table->id();
            $table->string('verifiable_type');
            $table->unsignedBigInteger('verifiable_id');
            $table->string('code');
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index(['verifiable_type', 'verifiable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_verification_codes');
    }
};
