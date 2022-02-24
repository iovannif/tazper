<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobrosDetalleTable extends Migration
{
    public function up()
    {
        Schema::create('CobrosDetalle', function (Blueprint $table){
            // $table->increments('Id_Cob')->unsigned();
            // $table->integer('Id_Ven')->length(4)->nullable();
            // $table->string('Cob_Est',10);
            // $table->integer('Id_PedCli')->length(4)->nullable();
            // $table->unsignedInteger('Cob_In');

            // $table->timestamps();

            $table->unsignedInteger('Id_Cob')->index();                                                       
            $table->string('CD_Art', 35);       
            $table->unsignedInteger('CD_ArtPre');   
            $table->unsignedInteger('CD_ArtCant'); 
            $table->unsignedInteger('CD_ArtDesc')->nullable();       
            $table->unsignedInteger('CD_ArtTot');            
        });
    }

    public function down()
    {
        Schema::dropIfExists('CobrosDetalle');
    }
}
