<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Item;
use App\Order;
use Carbon\Carbon;
use App\Events\NewOrder;
class OrderController extends Controller
{
    public function index() {
        return response()->json(Order::query()->orderBy('created_at')->get());
    }

    public function store(Request $request) {
        $request['client'] = "Mesa No. " . $request['tableId']; 
        $order = Order::create($request->all());
        foreach($request['items'] as $itemName) {
            $item = Item::where('name','=', $itemName)->firstOrFail();
            $order->items()->save($item, ['quantity' => 1]);
        }
        event(new NewOrder($request['tableId'], $order));
        return Order::where('id', $order->id)->with('items')->first()->toJson();
    }

    public function items(Order $order) {
        return response()->json($order->items);
    }
}
