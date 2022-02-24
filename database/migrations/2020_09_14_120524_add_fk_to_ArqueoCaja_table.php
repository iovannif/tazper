<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToArqueoCajaTable extends Migration
{
    public function up()
    {
        Schema::table('ArqueoCaja', function (Blueprint $table) {
            $table->foreign('Id_Caj')->references('Id_Caj')->on('Caja');
        });
    }

    public function down()
    {
        Schema::table('ArqueoCaja', function (Blueprint $table) {
            $table->dropForeign(['Id_Caj']);
        });
    }
}