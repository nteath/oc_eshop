<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('total_amount');
            $table->integer('amount_paid');
            $table->dateTime('paid_at');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
