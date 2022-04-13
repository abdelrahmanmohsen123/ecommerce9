<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('code',32)->unique();
            $table->tinyInteger('quantity');
            $table->decimal('price');
            $table->tinyInteger('status')->default()->comment('0=>not active , 1=>active');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('shop_id')->constrained();
            $table->foreignId('model_id')->constrained();
            $table->timestamps();
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
}
