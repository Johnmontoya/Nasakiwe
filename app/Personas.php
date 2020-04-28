<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table = 'personas';

    protected $fillable = ['cedula', 'nombre', 'apellido'];

    public function user(){

        return $this->hasOne('App\User');
    }

}
