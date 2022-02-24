<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToCobrosDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('CobrosDetalle', function (Blueprint $table) {
            $table->foreign('Id_Cob')->references('Id_Cob')->on('Cobros');
        });
    }

    public function down()
    {
        Schema::table('CobrosDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Cob']);
        });
    }
}
