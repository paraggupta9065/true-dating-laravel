<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sociallogins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('provider'); 
            $table->string('provider_id'); 
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('sociallogins');
    }
};
