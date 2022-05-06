<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tdproductionorder', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('machine_id');
            $table->unsignedBigInteger('productionline_id');
            $table->unsignedBigInteger('schedule_id');
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
            
            $table->dropColumn('productionline_id');
            $table->dropColumn('schedule_id');
            $table->string('name');
            $table->bigInteger('machine_id');
        });
    }
}
