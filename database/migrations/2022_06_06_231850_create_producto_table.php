<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mes');
            $table->string('empleado');
            $table->string('vendedor');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')-> references ('id')->on('categoria')->onDelete('cascade');
            $table->string('producto');
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->string('cliente');
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
        Schema::dropIfExists('producto');
    }
}
