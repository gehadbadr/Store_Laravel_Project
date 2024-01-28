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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->string('tracking_no');
            $table->string('phone');
            $table->enum('status',['-1','0','1'])->default('0')->comment('0=in progress,1=closed,-1=cancelled');
            $table->enum('payment_mode',['0','1'])->default('0')->comment('0= cash,1=online');
            $table->string('payment_id')->nullable();
            //don't remove price cause of you delete cart and discount_price is expired the price in order will lost .
            $table->string('total_price');
            $table->string('shipping_price');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('user_addresses')->onDelete('cascade');
       
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
