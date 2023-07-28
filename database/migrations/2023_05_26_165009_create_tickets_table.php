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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->text('description');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('seen')->default(0)->comment('0 => unseen, 1 => seen');
            $table->foreignId('reference_id')->constrained('ticket_admins')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('ticket_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('priority_id')->constrained('ticket_priorities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ticket_id')->constrained('tickets')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
