<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TITLE_MAX_LEN = 70;
    const EXCERPT_MAX_LEN = 100;
    const IMAGE_URL_MAX_LEN = 256;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id');
            $table->string('title', static::TITLE_MAX_LEN);
            $table->string('excerpt', static::EXCERPT_MAX_LEN)->nullable();
            $table->text('body');
            $table->unsignedInteger('minutes_to_read');
            $table->string('image_url',static::IMAGE_URL_MAX_LEN)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
