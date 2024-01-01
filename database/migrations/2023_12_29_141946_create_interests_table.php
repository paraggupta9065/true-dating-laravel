<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('food_drink')->nullable();
            $table->string('creativity')->nullable();
            $table->string('movies_tv')->nullable();
            $table->string('sports')->nullable();
            $table->string('staying_in')->nullable();
            $table->string('going_out')->nullable();
            $table->string('music')->nullable();
            $table->string('travel_explore')->nullable();
            $table->string('pets')->nullable();
            $table->string('reading')->nullable();
            $table->string('value_character')->nullable();
            $table->timestamps();

            // Define foreign key relationship
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('interests');
    }
};
