<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFulltimeToTcschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tdschedules', function (Blueprint $table) {
            //
            $table->integer('fulltime')->nullable()->after('turn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tdschedules', function (Blueprint $table) {
            //
            $table->dropColumn('fulltime');
        });
    }
}
