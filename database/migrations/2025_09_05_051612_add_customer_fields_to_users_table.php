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
            $table->string('customer_number')->unique()->nullable()->after('email');
            $table->string('code')->nullable()->after('customer_number');
            $table->string('phone_code')->nullable()->after('phone');
            $table->text('pickup_address')->nullable()->after('phone_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
