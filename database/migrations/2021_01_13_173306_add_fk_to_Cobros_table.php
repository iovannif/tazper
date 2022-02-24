<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToCobrosTable extends Migration
{
    public function up()
    {
        Schema::table('Cobros', function (Blueprint $table) {
            $table->foreign('Id_Ven')->references('Id_Ven')->on('Ventas');
        });
    }

    public function down()
    {
        Schema::table('Cobros', function (Blueprint $table) {
            $table->dropForeign(['Id_Ven']);
        });
    }
}