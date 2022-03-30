<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);;
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $lineas = Line::pluck('name','id');
        return view('products.create',compact('product','lineas'));
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
            'part_number' => 'required|unique:tcproducts|max:255',
            'cost' => 'required|max:255',
            'cycle' => 'required|max:255',
            'unit' => 'required|max:255',
            'productionline_id' => 'required|max:255',
          
             ]);
        
          $data = [
                    'part_number'        => $request->get('part_number'),
                    'cost'        => $request->get('cost'),
                    'cycle'      => $request->get('cycle'), 
                    'unit'         => $request->get('unit'),
                    'productionline_id'     => $request->get('productionline_id'),
                ];
        
               $product= Product::create($data);
                $message = $product ? 'Producto agregado correctamente!' : 'NO se pudo agregar!';    
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
        $products= Product::find($id);
        $lineas = Line::pluck('name','id');
        return view('products.edit',compact('products','lineas'));
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
                'part_number' => 'required|unique:tcproducts,part_number,'.$id,
                'cost' => 'required|max:255',
                'cycle' => 'required|max:255',
                'unit' => 'required|max:255',
                'productionline_id' => 'required|max:255',
              
                 ]);          
//Actualizar la informacion
     $products = Product::find($id);
     $products->part_number = $request->get("part_number");
     $products->cost = $request->get("cost");
     $products->cycle = $request->get("cycle");
     $products->unit = $request->get("unit");
     $products->productionline_id = $request->get("productionline_id");
     $products->save();
     return redirect()->route('tab2');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy(Product $product)
    {
        
        $product->delete();
        return redirect()->route('tab2')->with('eliminar', 'ok');
    }
}
