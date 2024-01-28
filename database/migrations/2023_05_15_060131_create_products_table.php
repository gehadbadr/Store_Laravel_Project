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
        Schema::create('products', function (Blueprint $table) {
           /* $table->id();
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->longtext('desc');
            $table->string('image');
            $table->decimal('price',8,2)->nullable();
            $table->decimal('discount_price',8,2)->nullable();
            $table->integer('statue')->default('1');
            $table->timestamps();
            $table->softdeletes();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
*//*
            $table->id();
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->longText('description');
            $table->string('image');
            $table->decimal('price',8,2)->nullable();
            $table->decimal('discount_price', 8,2)->nullable();
           $table->timestamps();
            $table->softDeletes();
            */
            $table->id();
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->mediumText('mini_desc');
            $table->string('image')->nullable();

            $table->decimal('price',8,2);
            $table->decimal('discount_price', 8,2)->nullable();
            $table->integer('qty')->nullable();
            $table->enum('trending',['1','0'])->default('0')->comment('0=trending,1=not-trending');
          //--funDA CODE --- $table->tinyInteger('status')->default('0')->comment('0=visible,1=hidden');
            $table->enum('status',['1','0'])->default('0')->comment('0=visible,1=hidden');

            $table->string('meta_title');
            $table->mediumText('meta_keyword');
            $table->mediumText('meta_desc');
         
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
