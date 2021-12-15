<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesFacebookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_facebook', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('url_services');
            $table->string('id_fb');
            $table->string('name_fb');
            $table->string('speed');
            $table->string('type');
            $table->integer('warranty');
            $table->integer('total_price');
            $table->integer('total_warranty');
            $table->boolean('checkpoint');
            $table->string('service_code');
            $table->string('transaction_code');
            $table->integer('number');
            $table->integer('number_success');
            $table->string('status');
            $table->timestamp('updateTime');
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
        Schema::dropIfExists('services_facebook');
    }
}
