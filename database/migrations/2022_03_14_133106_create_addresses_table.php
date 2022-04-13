<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street',255);
            $table->string('building',255);
            $table->string('floor',255);
            $table->string('flat',255);
            $table->string('notes',255);
            $table->tinyInteger('status')->default(0)->comment('1=>deleiverd_in , 0=>not_deleverd');
            $table->foreignId('user_id')->constrained();

            $table->foreignId('region_id')->constrained();

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
        Schema::dropIfExists('addresses');
    }
}
