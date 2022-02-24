<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPagosDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('PagosDetalle', function (Blueprint $table) {
            $table->foreign('Id_Pag')->references('Id_Pag')->on('Pagos')->onDelete('cascade'); //bd
        });
    }

    public function down()
    {
        Schema::table('PagosDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Pag']);
        });
    }
}
