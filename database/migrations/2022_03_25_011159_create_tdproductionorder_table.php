<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdproductionorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdproductionorder', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('machine_id');
            $table->bigInteger('productionorderstatus_id');
            $table->bigInteger('product_id');
            $table->timestamp('start_time')->nullable();;
            $table->timestamp('end_time')->nullable();;
            $table->integer('scrap');
            $table->integer('total');
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
        Schema::dropIfExists('tdproductionorder');
    }
}
