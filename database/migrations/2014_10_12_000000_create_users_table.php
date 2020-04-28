<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_persona')->unsigned();
            $table->bigInteger('id_rol')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('estado')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade');
        });
        DB::table('users')->insert(array('id'=>'1','id_persona'=>'1','id_rol'=> '1',
        'name'=>'admin','email'=>'admin@gmail.com',
        'password'=>'$2y$10$.aKA2oTZOQDVlkwDCXXbzO2r6rfXliKzYL9.1Fi2MBR8I.9LvmZZW', 'estado'=>'1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
