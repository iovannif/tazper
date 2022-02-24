<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToClientesTable extends Migration
{
    public function up()
    {
        Schema::table('Clientes', function (Blueprint $table) {
            $table->foreign('Id_Lp')->references('Id_Lp')->on('ListaPrecio');
        });
    }

    public function down()
    {
        Schema::table('Clientes', function (Blueprint $table) {
            $table->dropForeign(['Id_Lp']);
        });
    }
}