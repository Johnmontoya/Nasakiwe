<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->Integer('cedula')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->timestamps();
        });
        DB::table('personas')->insert(array('id'=>'1','cedula'=>'000','nombre'=>'admin','apellido'=> 'admin'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
