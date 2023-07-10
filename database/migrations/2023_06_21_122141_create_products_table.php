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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_id');
            // $table->foreign('product_category_id')->references('id')->on('product_category');
            $table->string('slug',255)->nullable();
            $table->string('name',255)->nullable();
            $table->float('price')->unsigned();
            $table->float('discount_price')->unsigned();
            $table->text('short_desscription')->nullable();
            $table->unsignedInteger('qty')->unsigned();
            $table->string('shipping',255)->nullable();
            $table->float('weight')->unsigned();
            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->string('image_url',255);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
