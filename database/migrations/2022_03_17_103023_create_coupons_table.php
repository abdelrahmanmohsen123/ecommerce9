<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('code')->unique();
            $table->tinyInteger('discount');
            $table->enum('discount_type',['p','f'])->default('f')->comment('f->fixed,p=>percentage');
            $table->smallInteger('mini_order_price')->nullable();
            $table->smallInteger('max_discount_value')->nullable();
            $table->smallInteger('max_usage-count')->nullable();
            $table->smallInteger('max_usage-count_per_user')->nullable();
            $table->tinyInteger('website_percentae')->default('100');
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
        Schema::dropIfExists('coupons');
    }
}
