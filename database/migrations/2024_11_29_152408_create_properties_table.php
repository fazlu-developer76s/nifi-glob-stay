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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->comment('categories.id');
            $table->string('state');
            $table->string('place');
            $table->string('price')->comment('price in on day');
            $table->string('booking_days')->nullable();
            $table->string('distance')->nullable();
            $table->string('location')->nullable();
            $table->string('room_type')->nullable();
            $table->string('room_size')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-Active,2-Inactive,3-Deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
