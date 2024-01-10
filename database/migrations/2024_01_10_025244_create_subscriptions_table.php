<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_duration');
            $table->enum('plan_name', ['Basic', 'Premium', 'Pro']); 
            $table->decimal('price', 8, 2);
            $table->string('saved_percentage');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
