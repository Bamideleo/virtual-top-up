<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpinsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epins_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('product_name');
            $table->string('type');
            $table->string('status');
            $table->integer('amount');
            $table->string('date');
            $table->string('pin');
            $table->string('serialNumber');
            $table->string('phone_number');
            $table->string('real_amount');
            $table->string('token');
            $table->string('units');
            $table->string('customerAddress');
            $table->string('phase');
            $table->string('customerName');
            $table->string('purchase_code');
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
        Schema::dropIfExists('epins_histories');
    }
}
