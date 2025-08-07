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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->text('pickup_address');
            $table->string('recipient_name');
            $table->text('delivery_address');
            $table->string('recipient_phone');
            $table->text('delivery_notes')->nullable();
            $table->enum('item_type', ['Small', 'Medium', 'Large']);
            $table->integer('number_of_items');
            $table->decimal('price', 10, 2); // Price based on item type and quantity
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
