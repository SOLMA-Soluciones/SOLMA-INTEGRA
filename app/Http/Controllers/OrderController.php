<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Productionstop;
use App\Models\Schedule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineas = Order::getLinesWithProductsAndTurns();
        $motivos = Productionstop::all();
        $products = Product::paginate(5);;
        $usuarios = User::paginate(5);
        $schedules = Schedule::getSchedules();
        $orders = Order::getOrders();
        return view('orders.index',compact('lineas','usuarios','products','motivos','schedules','orders'));
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
        //
        $data = [
            'productionline_id'=> $request->get('productionline_id'),
            'schedule_id'=> $request->get('schedule_id'),
            'total'=> $request->get('total'),
            'product_id'=>$request->get('product_id'),
        ];
        $product= Order::create($data);
        // var_dump($request->total);
        return redirect()->route('orders.index');
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
    public function destroy(Order $order)
    {
        //
        $order->delete();
        return redirect()->route('orders.index');
    }

    public function turns($id){
        $turns = Order::getTurnsByLineId($id);
        return $turns;
    }
    public function products($id){
        $turns = Order::getProductsByLineId($id);
        return $turns;
    }
    
}
