<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\User;
use App\Models\Product;
use App\Models\Productionstop;
use App\Models\Schedule;
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
        $motivos = Productionstop::all();
        $products = Product::all();;
        $usuarios = User::all();
        $schedules = Schedule::getSchedules();
        return view('configuraciones.index',compact('lineas','usuarios','products','motivos','schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::select('name')
                   ->where('id','1')
                   ->get()->pluck('name','name');
        //$roles = Role::pluck('name','name')->all();
        return view('usuarios.crearoperador',compact('roles'));
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $user = User::find($id);
        $roles=Role::select('name')
                   ->where('id','1')
                   ->get()->pluck('name','name');
        $userRole = $user->roles->pluck('name','name')->all();

        return view('usuarios.editaroperador',compact('user','roles','userRole'));
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
