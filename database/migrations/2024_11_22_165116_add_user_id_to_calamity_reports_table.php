<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('calamity_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Add the user_id column if not already there

            // Add foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Set to CASCADE on delete (optional)
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calamity_reports', function (Blueprint $table) {
            //
        });
    }
};