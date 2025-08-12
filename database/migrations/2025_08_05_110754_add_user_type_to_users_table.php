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
            // Adding user_type column to the users table
            $table->string('phone')->nullable();
            $table->enum('user_type', ['Admin', 'Customer', 'Driver', 'Subscriber'])->default('Customer');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
              $table->dropColumn('user_type');
        });
    }
};
