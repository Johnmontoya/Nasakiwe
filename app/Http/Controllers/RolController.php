<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;

class RolController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()){
            return redirect('/');
        }
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar == ''){
            $roles = Roles::orderBy('id', 'desc')->paginate(10);
        }else{
            $roles = Roles::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id','desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total' => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page' => $roles->perPage(),
                'last_page' => $roles->lastPage(),
                'from' => $roles->firstItem(),
                'to' => $roles->lastitem(),
            ],
            'roles' => $roles
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()){
            return redirect('/');
        }
        $roles = new Roles();
        $roles->nombre = $request->nombre;
        $roles->condicion = 1;
        $roles->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()){
            return redirect('/');
        }
        $roles = Roles::findOrFail($request->id);
        $roles->nombre = $request->nombre;
        $roles->save();
    }

    public function selectRol(Request $request){

        if(!$request->ajax()){
            return redirect('/');
        }
        $roles = Roles::where('condicion','=','1')
        ->select('id','nombre')
        ->orderBy('nombre','asc')->get();

        return ['roles' => $roles];
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()){
            return redirect('/');
        }
        $roles = Roles::findOrFail($request->id);
        $roles->condicion = '0';
        $roles->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()){
            return redirect('/');
        }
        $roles = Roles::findOrFail($request->id);
        $roles->condicion = '1';
        $roles->save();
    }
}
