<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        Schedule::insertarDatos($request);
        return redirect()->route('tab3');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($b64)
    {
        $json  = base64_decode($b64);
        $data = json_decode($json);
        $id = $data->id;
        $turn = $data->turn;
        $schedule = Schedule::getScheduleById($id, $turn);
        return response()->json($schedule);
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
        return "edit";
        // return response()->json($oDatos);

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
        $oDatos = (object)[
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
            "productionline_id" => $request->productionline_id,
            "days" => $request->selectSchedule,
            "turn" => $request->turn,
        ];
        $result = Schedule::guardarDatos($oDatos);
        return redirect()->route('tab3');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($b64)
    {
        $json  = base64_decode($b64);
        $data = json_decode($json);
        $id = $data->id;
        $turn = $data->turn;
        Schedule::deleteScheduleById($id, $turn);
        return response()->json([

            'success' => 'Record deleted successfully!'
    
        ]);
        // return redirect()->route('tab3')->with('eliminar', 'ok');
    }
}
