<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_number');
            $table->decimal('cost', 8, 2);
            $table->integer('cycle');
            $table->integer('unit');
            $table->unsignedBigInteger('productionline_id');
            $table->foreign('productionline_id')-> references ('id')->on('tcproductionline')->onDelete('cascade');
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
        Schema::dropIfExists('tcproducts');
    }
}
