<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Productionstop;
use App\Models\Timer;
use stdClass;

class TimerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::getOrdersInProcess();
        return view('timer.timer',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        var_dump("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        var_dump("store");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $stoppages = Productionstop::getStoppageByLineId($id);
        $colors = ["#80cbc4","#80deea","#81d4fa","#90caf9","#9fa8da","#b39ddb","#a5d6a7","#c5e1a5","#a5d6a7","#ffcc80","#ffe082","#fff59d"];
        $order = Order::getOrderById($id);
        $order = $order[0];
        $stoppages = Productionstop::getStoppageByOrderId($id);
        $StoppagesExecuted =  Order::getStoppagesExecuted($id);
        return view('timer.index',compact('stoppages','order','colors','id','StoppagesExecuted'));
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
        // var_dump("edit");
        return "edit";
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
        // var_dump("update");
        return "update";
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
        var_dump("destroy");
        return "destroy";
    }
    public function startOrder(Request $request){
        $id = $request->post("id");
        $start_time = $request->post("start_time");
        $order = Order::find($id);
        $order->start_time = $start_time;
        $order->productionorderstatus_id = 2;
        $order->save();
        return response()->json($order);
    }
    public function endOrder(Request $request){
        $id = $request->post("id");
        $end_time = $request->post("end_time");
        $order = Order::find($id);
        $order->end_time = $end_time;
        $order->productionorderstatus_id = 3;
        $order->save();
        return response()->json($order);
    }

    public function startStoppage(Request $request){
        $order = new stdClass;
        $order->start_time = $request->post("start_time");
        $order->productionorder_id = $request->post("productionorder_id");
        $order->productionstoppage_id = $request->post("productionstoppage_id");
        $order->status = 1;
        $orderStoppage = Order::startStoppage($order);
        return response()->json($orderStoppage);
    }
    public function stopStoppage(Request $request){
        $order = new stdClass;
        $order->end_time = $request->post("end_time");
        $order->productionorder_id = $request->post("productionorder_id");
        $order->productionstoppage_id = $request->post("productionstoppage_id");
        $order->status = 2;
        Order::stopStoppage($order);
        return response()->json($request);
    }
    public function getStoppageExecuted($idOrder){
        $Stoppages =  Order::getStoppagesExecuted($idOrder);
        return response()->json($Stoppages);
    }
    public function savetotalscrap(Request $request,$id){
        $total = $request->post("total_finish");
        $scrap = $request->post("scrap_finish");
        $order = Order::find($id);
        $order->total_produced = $total;
        $order->scrap = $scrap;
        $order->save();
        // return response()->json($order);
        return redirect()->route('timers.show',[$id]);
    }
   
}
