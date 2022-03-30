<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productionstop;
use Exception;

class ProductionstopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productionstoppages = Productionstop::orderBy('id', 'DESC')->get();
        return view('timer.index', compact('productionstoppages'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $Productos = Productionstop::findOrFail($request->id)->update(['estatus' => $request->estatus]);
        $productos = Productionstop::find($request->id);
        $productos->status = $request->get("status");

        $productos->save();
        if ($request->status == 0) {
            $newStatus = '<br> <button type="button" class="btn btn-sm btn-danger">Inactiva</button>';
        } else {
            $newStatus = '<br> <button type="button" class="btn btn-sm btn-success">Activa</button>';
        }

        return response()->json(['var' => '' . $newStatus . '']);
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
    public function edit($data)
    {
        // throw new Exception("Entro");
        // $NotiUpdate = Motivo::findOrFail($data->id)->update(['estatus' => $data->estatus]); 
        // return $NotiUpdate;
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
    public function destroy($id)
    {
        //
    }
}
