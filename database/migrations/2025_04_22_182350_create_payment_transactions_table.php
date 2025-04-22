<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable(); // If user logged in
            $table->string('booking_id')->nullable(); // If you link to a booking
            $table->string('payment_id'); // Razorpay payment ID
            $table->string('order_id')->nullable(); // Razorpay order ID (if used)
            $table->string('method')->nullable(); // E.g., card, netbanking, upi
            $table->decimal('amount', 10, 2); // Amount in INR
            $table->string('currency')->default('INR');
            $table->string('status'); // captured, failed, etc.
            $table->text('response')->nullable(); // Full JSON response
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_transactions');
    }
}
