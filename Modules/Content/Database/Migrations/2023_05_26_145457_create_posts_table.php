<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('summary', 150);
            $table->text('description');
            $table->text('image');
            $table->string('slug')->unique()->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('comment_able')->default(0);
            $table->text('tags');
            $table->string('published_at');

            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('category_id')->constrained('post_categories');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
