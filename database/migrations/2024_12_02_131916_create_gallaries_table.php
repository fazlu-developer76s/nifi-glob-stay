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
        Schema::create('gallaries', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->timestamps();
            $table->tinyInteger('status')->default(1)->comment('1-Active,2-InActive,3-Deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallaries');
    }
};
