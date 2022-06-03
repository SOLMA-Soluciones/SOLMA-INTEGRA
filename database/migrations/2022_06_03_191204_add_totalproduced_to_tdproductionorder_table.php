<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalproducedToTdproductionorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tdproductionorder', function (Blueprint $table) {
            //
            $table->integer('total_produced')->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tdproductionorder', function (Blueprint $table) {
            //
            $table->dropColumn('total_produced');
        });
    }
}
