<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('profile_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liked_by');  // User who liked
            $table->unsignedBigInteger('liked_to');  // User who got liked
            $table->timestamps();

            
            $table->foreign('liked_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('liked_to')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('profile_likes');
    }
};
