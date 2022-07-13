<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;



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
        return view('dbgproductos.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = new Producto();
        $categorias = Categoria::pluck('nombre','id');
        return view('dbgproductos.create',compact('productos','categorias'));
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
            'mes' => 'required|max:255',
            'empleado' => 'required|max:255',
            'vendedor' => 'required|max:255',
            'categoria_id' => 'required|max:255',
            'producto' => 'required|max:255',
            'cantidad' => 'required|max:255',
            'precio' => 'required|max:255',
            'cliente' => 'required|max:255',
          
             ]);
        
          $data = [
                    'mes'=> $request->get('mes'),
                    'empleado'=> $request->get('empleado'),
                    'vendedor'=> $request->get('vendedor'),
                    'categoria_id'=> $request->get('categoria_id'),
                    'producto'=> $request->get('producto'), 
                    'cantidad'=> $request->get('cantidad'),
                    'precio'=> $request->get('precio'),
                    'cliente'=> $request->get('cliente')
                    
                ];
        
               $product= Producto::create($data);
                $message = $product ? 'Producto agregado correctamente!' : 'NO se pudo agregar!';    
                return redirect()->route('productos.index')->with('message', $message);
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
        $productos = new Producto();
        $categorias = Categoria::pluck('nombre','id');
        return view('dbgproductos.edit',compact('productos','categorias'));
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
                'mes' => 'required|max:255',
                'empleado' => 'required|max:255',
                'vendedor' => 'required|max:255',
                'categoria_id' => 'required|max:255',
                'producto' => 'required|max:255',
                'cantidad' => 'required|max:255',
                'precio' => 'required|max:255',
                'cliente' => 'required|max:255',
              
                 ]);
            //Actualizar la informacion
            $products = Producto::find($id);
            $products->mes = $request->get("mes");
            $products->empleado = $request->get("empleado");
            $products->vendedor = $request->get("vendedor");
            $products->categoria_id = $request->get("categoria_id");
            $products->producto = $request->get("producto");
            $products->cantidad = $request->get("cantidad");
            $products->precio = $request->get("precio");
            $products->cliente = $request->get("cliente");
            $products->save();
            return redirect()->route('dbgproductos.index');
            
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productos->delete();
        return redirect()->route('productos.index')->with('eliminar', 'ok');
    }
}
