<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;


class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machines = Machine::paginate(5);;
        return view('machines.index',compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $machine = new Machine();
        return view('machines.create',compact('machine'));
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
             ]);
        
          $data = [
                    'name'        => $request->get('name'),
                    'description'        => $request->get('description'),
                ];
        
               $machine= Machine::create($data);
                $message = $machine ? ' Maquina agregada!' : 'NO se pudo agregar!';    
                return redirect()->route('machines.index')->with('message', $message);

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
        $machines= Machine::find($id);
        return view('machines.edit',compact('machines'));
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
   
          
             ]); 

        $machines = Machine::find($id);
        $machines->name = $request->get("name");
        $machines->description = $request->get("description");
        $machines->save();
        return redirect()->route('machines.index');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Machine $machine)
    {
        $machine->delete();
        return redirect()->route('machines.index')->with('eliminar', 'ok');
    }

}
