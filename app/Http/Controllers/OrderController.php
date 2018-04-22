<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Item;
use App\Order;
use Carbon\Carbon;
use App\Events\NewOrder;
use GuzzleHttp\Client as GuzzleClient;
class OrderController extends Controller
{
    public function index() {
        return response()->json(Order::query()->orderBy('created_at')->get());
    }

    public function store(Request $request) {
    
        $request['client'] = "Mesa No. " . $request['tableId']; 
        $order = Order::create($request->all());
        foreach($request['items'] as $receiveditem) {
            $item = Item::where('name','=', $receiveditem['name'])->firstOrFail();
            $order->items()->save($item, ['quantity' => $receiveditem['quantity'] ] );
        }
        event(new NewOrder($request['tableId'], $order));
        $this->sendNotification($order);
        return Order::where('id', $order->id)->with('items')->first()->toJson();
    }

    public function items(Order $order) {
        return response()->json($order->items);
    }

    public function sendNotification(Order $order){
        $client = new GuzzleClient ([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key=AAAAvtNOCBE:APA91bHQWTJ3o4Kl7e6jr_BDN0W2OcZUigV-33WRt-O0AYfHAJZ_e9jd0Gu2l1Yd-6E1tC7aOu3hEdrMBp_CygrY4DKcVkHFpTciy5hq1zqC9kTrERfPrzvLErrkCpXVb-cbXxeaPAPY'
            ]    
        ]);
        $messageData =[
            'to' => $order->token,
            'data' => [
                'order_id' => $order->id
            ],
            'notification' => [
                'title' => "Orden lista",
                'body' => "Su orden esta lista"
            ]
        ];
        $response = $client->request('POST','https://fcm.googleapis.com/fcm/send',[
            'json' => $messageData
        ]);


    }
}
