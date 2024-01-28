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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('product_id');
            $table->string('color');
            $table->enum('status',['1','0'])->default('0')->comment('0=visible,1=hidden');
 
            //  $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
             $table->timestamps();
             $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');
    }
};
