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
        Schema::create('property_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Reference to users.id');
            $table->text('review');
            $table->decimal('rating', 3, 1)->comment('Rating out of 5, e.g., 4.5');
            $table->tinyInteger('status')->default(1)->comment('1-Active, 2-Inactive, 3-Deleted')->unsigned();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_reviews');
    }
};
