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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('password');
            $table->string('reset_token')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('video_intro')->nullable();
            $table->string('gender')->nullable();
            $table->string('looking_for')->nullable();
            $table->string('profession')->nullable();
            $table->string('relationship_status')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('current_location')->nullable();
            $table->string('home_location')->nullable();
            $table->string('body_type')->nullable();
            $table->string('exercise')->nullable();
            $table->boolean('kids')->nullable();
            $table->string('religion')->nullable();
            $table->boolean('high_school')->nullable();
            $table->boolean('trade_tech_school')->nullable();
            $table->boolean('in_college')->nullable();
            $table->boolean('ug_degree')->nullable();
            $table->boolean('graduate_degree')->nullable();
            $table->boolean('in_grade_school')->nullable();
            $table->boolean('push_notification_enabled')->default(false);
            $table->double('latitude', 10, 6)->nullable();
            $table->double('longitude', 10, 6)->nullable();
            $table->timestamps();
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
