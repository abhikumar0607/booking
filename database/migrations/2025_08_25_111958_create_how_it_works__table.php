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
        Schema::create('how_it_works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            // 4 sections
            $table->string('section1_title')->nullable();
            $table->text('section1_desc')->nullable();
            $table->string('section2_title')->nullable();
            $table->text('section2_desc')->nullable();
            $table->string('section3_title')->nullable();
            $table->text('section3_desc')->nullable();
            $table->string('section4_title')->nullable();
            $table->text('section4_desc')->nullable();
    
            $table->enum('status', ['active','inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('how_it_works_');
    }
};
