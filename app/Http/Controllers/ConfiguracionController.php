<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\User;
use App\Models\Product;
use App\Models\Motivo;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ConfiguracionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-user|editar-user|borrar-user', ['only' => ['index']]);
         $this->middleware('permission:crear-user', ['only' => ['create','store']]);
         $this->middleware('permission:editar-user', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineas = Line::all();
        $motivos = Motivo::all();
        $products = Product::paginate(5);;
        $usuarios = User::paginate(5);
        return view('configuraciones.index',compact('lineas','usuarios','products','motivos'));
    }

    /**
     * Show the form for creating a new resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $NotiUpdate = Motivo::findOrFail($request->id)->update(['estatus' => $request->estatus]); 
    
        if($request->estatus == 0)  {
            $newStatus = '<br> <button type="button" class="btn btn-sm btn-danger">Inactiva</button>';
        }else{
            $newStatus ='<br> <button type="button" class="btn btn-sm btn-success">Activa</button>';
        }
        return response()->json(['var'=>''.$newStatus.'']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $linea)
    {
       
    }
}
