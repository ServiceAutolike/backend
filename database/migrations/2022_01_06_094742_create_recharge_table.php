<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('type');
            $table->string('transaction_code');
            $table->integer('amount');
            $table->integer('fee')->default(0);
            $table->integer('amount_end');
            $table->integer('discount')->default(0);
            $table->string('memo');
            $table->string('status')->default("Success");
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
        Schema::dropIfExists('recharge');
    }
}
