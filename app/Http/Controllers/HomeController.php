<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Productionstop;
use App\Models\Line;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Productionstop;
use App\Models\Schedule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            // $productionstoppages = Productionstop::orderBy('id', 'DESC')->get();
            // return view('timer.index', compact('productionstoppages'));

            $lineas = Order::getLinesWithProductsAndTurns();
            $motivos = Productionstop::all();
            $products = Product::paginate(5);;
            $usuarios = User::paginate(5);
            $schedules = Schedule::getSchedules();
            $orders = Order::getOrders();
            return view('orders.index',compact('lineas','usuarios','products','motivos','schedules','orders'));
        
    }
    
}
