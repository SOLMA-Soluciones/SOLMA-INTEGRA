<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motivo;

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
            $motivos = Motivo::orderBy('id', 'DESC')->get();
            return view('timer.index', compact('motivos'));
        
    }
    
}
