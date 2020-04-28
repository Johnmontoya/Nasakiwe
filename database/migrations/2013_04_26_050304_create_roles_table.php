<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Administrador','condicion'=> '1'));
        DB::table('roles')->insert(array('id'=>'2','nombre'=>'Usuario','condicion'=> '1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
