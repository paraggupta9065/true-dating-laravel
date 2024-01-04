<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // use for update the the user table 
    // new column added latitude and longitude
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable()->after('email'); 
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};
