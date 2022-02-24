<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaTable extends Migration
{
    public function up()
    {
        Schema::create('Categoria', function (Blueprint $table){
            $table->increments('Id_Cat')->unsigned();
            $table->string('Cat_Des',20)->unique();
            $table->string('Cat_Est',8);
            $table->string('Cat_Obs',140)->nullable();

                $table->timestamps();

                $table->unsignedInteger('Cat_RegPor')->nullable();
                $table->string('Cat_RegUser',20)->nullable();
                $table->unsignedInteger('Cat_MdfPor')->nullable();
                $table->string('Cat_MdfUser',20)->nullable();

                $table->unsignedInteger('Id_Usu')->nullable();            
        });
    }

    public function down()
    {
        Schema::dropIfExists('Categoria');
    }
}