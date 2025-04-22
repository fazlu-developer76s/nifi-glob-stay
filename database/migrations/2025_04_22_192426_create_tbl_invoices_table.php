<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->string('invoice_number')->unique();
            $table->decimal('amount', 10, 2); // Total amount
            $table->decimal('tax_percent', 5, 2); // Tax percentage
            $table->decimal('tax_amount', 10, 2); // Tax amount
            $table->string('invoice_url'); // URL of the generated invoice PDF
            $table->timestamps();

            // Foreign key relation to tbl_bookings (optional)
            $table->foreign('booking_id')->references('id')->on('tbl_bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_invoices');
    }
}
