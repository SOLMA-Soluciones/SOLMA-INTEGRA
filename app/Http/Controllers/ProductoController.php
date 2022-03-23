<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linea;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate(5);;
        return view('productos.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();
        $lineas = Linea::pluck('nombre','id');
        return view('productos.crear',compact('producto','lineas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'numero' => 'required|unique:productos|max:255',
            'costo' => 'required|max:255',
            'max_hora' => 'required|max:255',
            'unidad' => 'required|max:255',
            'linea_id' => 'required|max:255',
          
             ]);
        
          $data = [
                    'numero'        => $request->get('numero'),
                    'costo'        => $request->get('costo'),
                    'max_hora'      => $request->get('max_hora'), 
                    'unidad'         => $request->get('unidad'),
                    'linea_id'     => $request->get('linea_id'),
                ];
        
               $producto= Producto::create($data);
                $message = $producto ? 'Producto agregado correctamente!' : 'NO se pudo agregar!';    
                return redirect()->route('tab2')->with('message', $message);
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
        $productos= Producto::find($id);
        $lineas = Linea::pluck('nombre','id');
        return view('productos.editar',compact('productos','lineas'));
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
             $this->validate($request,[
                'numero' => 'required|unique:productos,numero,'.$id,
                'costo' => 'required|max:255',
                'max_hora' => 'required|max:255',
                'unidad' => 'required|max:255',
                'linea_id' => 'required|max:255',
              
                 ]);          


//Actualizar la informacion
     $productos = Producto::find($id);
     $productos->numero = $request->get("numero");
     $productos->costo = $request->get("costo");
     $productos->max_hora = $request->get("max_hora");
     $productos->linea_id = $request->get("linea_id");
     $productos->save();
     return redirect()->route('tab2');


             
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy(Producto $producto)
    {
        
        $producto->delete();
        return redirect()->route('tab2')->with('eliminar', 'ok');
    }
}
