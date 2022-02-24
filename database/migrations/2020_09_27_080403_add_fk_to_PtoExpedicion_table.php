<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPtoExpedicionTable extends Migration
{
    public function up()
    {
        Schema::table('PtoExpedicion', function (Blueprint $table) {
            $table->foreign('Id_Suc')->references('Id_Suc')->on('Sucursal');
        });
    }

    public function down()
    {
        Schema::table('PtoExpedicion', function (Blueprint $table) {
            $table->dropForeign(['Id_Suc']);
        });
    }
}