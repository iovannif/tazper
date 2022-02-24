<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToPagosTable extends Migration
{
    public function up()
    {
        Schema::table('Pagos', function (Blueprint $table) {
            $table->foreign('Id_Arq')->references('Id_Arq')->on('ArqueoCaja');
            $table->foreign('Id_MedPag')->references('Id_MedPag')->on('Medio_Pago');
            $table->foreign('Id_Caj')->references('Id_Caj')->on('Caja');
            $table->foreign('Id_Suc')->references('Id_Suc')->on('Sucursal');
            $table->foreign('Id_PtoExp')->references('Id_PtoExp')->on('PtoExpedicion');            

            // $table->foreign('Id_Pag')->references('Id_Pag')->on('Compras');
            //no se puede insertar porque es fk
        });
    }

    public function down()
    {
        Schema::table('Pagos', function (Blueprint $table) {
            // $table->dropForeign(['Id_Arq','Id_MedPag','Id_Caj','Id_Suc','Id_PtoExp']);
            $table->dropForeign(['Id_Arq']);
            $table->dropForeign(['Id_MedPag']);
            $table->dropForeign(['Id_Caj']);
            $table->dropForeign(['Id_Suc']);
            $table->dropForeign(['Id_PtoExp']);

            // $table->dropForeign(['Id_Pag']);
        });
    }
}