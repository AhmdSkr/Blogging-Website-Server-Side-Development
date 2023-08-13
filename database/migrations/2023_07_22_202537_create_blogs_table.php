<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const NAME_MAX_LEN = 50;
    const DESCRIPTION_MAX_LEN = 100;
    const IMAGE_URL_MAX_LEN = 256;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name', static::NAME_MAX_LEN)->unique();
            $table->string('description', static::DESCRIPTION_MAX_LEN)->nullable();
            $table->string('image_url', static::IMAGE_URL_MAX_LEN)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
