<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TARGET_POST_INDEX = 'reviews_index';
    const TARGET_POST_FOREIGN_COLUMN = 'target_id';
    const TARGET_POST_FOREIGN_KEY = 'target_post_foreign';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger(static::TARGET_POST_FOREIGN_COLUMN)->nullable(true);

            $table->foreign(static::TARGET_POST_FOREIGN_COLUMN, static::TARGET_POST_FOREIGN_KEY)
                ->references('id')->on('posts')
                ->cascadeOnDelete();
            
            $table->index(static::TARGET_POST_FOREIGN_COLUMN,  static::TARGET_POST_INDEX);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::getConnection()->getName() == 'sqlite')
        {
            Schema::dropIfExists('posts');
        }
        else
        {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropForeign(static::TARGET_POST_FOREIGN_KEY);
                $table->dropIndex(static::TARGET_POST_INDEX);
                $table->dropColumn(static::TARGET_POST_FOREIGN_COLUMN);
            });
        }
    }
};
