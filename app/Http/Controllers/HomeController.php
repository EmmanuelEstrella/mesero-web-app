<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Robot;
use App\Order;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function orders() 
    {
        Log::channel('daily')->debug("Entered ORDERS Page");
        
        return view('orders.index', [
            'robots' => Robot::all(), 
            'sentOrders' => Order::where('status', 'SENT')->get(),
            'newOrders' => Order::where('status', 'NEW')->orderBy('created_at', 'DES')->get(),
        ]);
    }
}
