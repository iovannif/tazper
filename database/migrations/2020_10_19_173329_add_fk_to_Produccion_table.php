<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToProduccionTable extends Migration
{
    public function up()
    {
        Schema::table('Produccion', function (Blueprint $table) {
            $table->foreign('Id_Prod')->references('Id_Art')->on('Articulos');
        });
    }

    public function down()
    {
        Schema::table('Produccion', function (Blueprint $table) {
            $table->dropForeign(['Id_Prod']);
        });
    }
}