<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('url_services');
            $table->string('id_fb')->nullable();
            $table->string('id_instagram')->nullable();
            $table->string('id_tiktok')->nullable();
            $table->string('id_youtube')->nullable();
            $table->string('id_shopee')->nullable();
            $table->string('id_lazada')->nullable();
            $table->string('name_fb')->nullable();
            $table->string('speed')->default("high");
            $table->string('type_services');
            $table->integer('warranty')->default(7);
            $table->integer('total_price')->default(0);
            $table->integer('total_warranty');
            $table->boolean('checkpoint')->default(false);
            $table->string('service_code');
            $table->string('transaction_code');
            $table->integer('number')->default(0);
            $table->integer('number_success')->default(0);
            $table->string('status')->default(1);
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
        Schema::dropIfExists('services');
    }
}
