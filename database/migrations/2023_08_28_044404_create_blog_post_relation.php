<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Blog;

return new class extends Migration
{
    const CONTAINER_BLOG_INDEX = 'blog_index';
    const CONTAINER_BLOG_FOREIGN_COLUMN = 'blog_id';
    const CONTAINER_BLOG_FOREIGN_KEY = 'blog_id_foreign';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function(Blueprint $table) {
            $table->unsignedBigInteger(static::CONTAINER_BLOG_FOREIGN_COLUMN)->nullable(true);

            $table->foreign(static::CONTAINER_BLOG_FOREIGN_COLUMN, static::CONTAINER_BLOG_FOREIGN_KEY)
                ->references('id')->on('posts')
                ->cascadeOnDelete();
            
            $table->index(static::CONTAINER_BLOG_FOREIGN_COLUMN,  static::CONTAINER_BLOG_INDEX);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function(Blueprint $table) {
            $table->dropForeign(static::CONTAINER_BLOG_FOREIGN_KEY);
            $table->dropIndex(static::CONTAINER_BLOG_INDEX);
            $table->dropColumn(static::CONTAINER_BLOG_FOREIGN_COLUMN);
        });
    }
};
