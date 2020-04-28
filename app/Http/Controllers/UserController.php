<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Personas;
use App\Roles;

class UserController extends Controller
{
    public function show(){

    	
    	$usuario = User::join('personas','users.id_persona','=','personas.id')
            ->join('roles','users.id_rol','=','roles.id')
            ->select('users.id','personas.nombre','personas.apellido','personas.cedula','users.email','users.name','users.estado','users.id_rol','roles.nombre as rol')
            ->orderBy('personas.id','desc')
            ->paginate(10);

    	return ['users' => $usuario];
    }

    public function store(Request $request)
    {

        try {

            DB::beginTransaction();
            $personas = new Personas();
            $personas->cedula = $request->cedula;
            $personas->nombre = $request->nombre;
            $personas->apellido = $request->apellido;
            $personas->save();

            $user = new User();
            $user->name = $request->username;
            $user->email = $request->correo;
            $user->password = bcrypt($request->password);
            $user->estado = '1';
            $user->id_rol = $request->id_rol;
            $user->id_persona = $personas->id;
            $user->save();            

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()){
            return redirect('/');
        }
        try {
            
            DB::beginTransaction();

            $user = User::findOrFail($request->id);

            $personas = Personas::findOrFail($user->id_persona);

            $personas->cedula = $request->cedula;
            $personas->nombre = $request->nombre;
            $personas->apellido = $request->apellido;
            $personas->save();

            $user->name = $request->username;
            $user->email = $request->correo;
            $user->password = bcrypt($request->password);
            $user->id_rol = $request->id_rol;
            $user->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()){
            return redirect('/');
        }
        $user = User::findOrFail($request->id);
        $user->estado = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()){
            return redirect('/');
        }
        $user = User::findOrFail($request->id);
        $user->estado = '1';
        $user->save();
    }
}
