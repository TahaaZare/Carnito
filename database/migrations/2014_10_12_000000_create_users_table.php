<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('adderss')->nullable();
            $table->string('job')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('code_meli')->unique()->nullable();
            $table->string('password');
            $table->text('profile_photo_path')->nullable()->comment('avatar');
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('activation')->default(0)->comment('0 -> not active | 1 -> active');
            $table->timestamp('activation_date')->nullable();
            $table->tinyInteger('user_type')->default(0)->comment('0 -> user | 1 -> admin');
            $table->tinyInteger('is_author')->default(0)->comment('0 -> no | 1 -> yes');
            $table->tinyInteger('status')->default(0);
            $table->foreignId('current_team_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
