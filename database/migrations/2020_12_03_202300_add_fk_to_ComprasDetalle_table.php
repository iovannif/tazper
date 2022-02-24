<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToComprasDetalleTable extends Migration
{
    public function up()
    {
        Schema::table('ComprasDetalle', function (Blueprint $table) {
            $table->foreign('Id_Com')->references('Id_Com')->on('Compras')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ComprasDetalle', function (Blueprint $table) {
            $table->dropForeign(['Id_Com']);
        });
    }
}