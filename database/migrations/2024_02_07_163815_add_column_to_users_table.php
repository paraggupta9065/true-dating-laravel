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
        Schema::table('users', function (Blueprint $table) {
            $table->string('height')->nullable()->after('longitude');
            $table->string('age')->nullable()->after('height');
            $table->string('relationship_goal')->nullable()->after('age');
            $table->string('ethinicity')->nullable()->after('relationship_goal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('age');
            $table->dropColumn('relationship_goal');
            $table->dropColumn('ethinicity');

        });
    }
};

