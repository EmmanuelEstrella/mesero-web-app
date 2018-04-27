<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Item;
use App\Order;
use App\Robot;
use Carbon\Carbon;
use App\Events\NewOrder;
use App\Events\RobotUpdate;
use App\Events\RobotCommand;
use GuzzleHttp\Client as GuzzleClient;
class OrderController extends Controller
{
    public function index() {
        return response()->json(Order::query()->orderBy('created_at')->get());
    }

    public function store(Request $request) {
    
        $request['client'] = "Mesa No. " . $request['tableId']; 
        $request['table_id'] = $request['tableId'];
        $order = Order::create($request->all());
        foreach($request['items'] as $receiveditem) {
            $item = Item::where('name','=', $receiveditem['name'])->firstOrFail();
            $order->items()->save($item, ['quantity' => $receiveditem['quantity'] ] );
        }
        event(new NewOrder($request['tableId'], $order));
        //$this->sendNotification($order);
        return Order::where('id', $order->id)->with('items')->first()->toJson();
    }

    public function items(Order $order) {
        return response()->json($order->items);
    }

    public function sendNotification(Order $order, Robot $robot){
        $client = new GuzzleClient ([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key=AAAAvtNOCBE:APA91bHQWTJ3o4Kl7e6jr_BDN0W2OcZUigV-33WRt-O0AYfHAJZ_e9jd0Gu2l1Yd-6E1tC7aOu3hEdrMBp_CygrY4DKcVkHFpTciy5hq1zqC9kTrERfPrzvLErrkCpXVb-cbXxeaPAPY'
            ]    
        ]);
        $messageData =[
            'to' => $order->token,
            'data' => [
                'order_id' => $order->id,
                'robot_id' => $robot->robot_id
            ],
        ];
        $response = $client->request('POST','https://fcm.googleapis.com/fcm/send',[
            'json' => $messageData
        ]);


    }

    public function updateRobotStatus(Request $request){

        $robot = Robot::updateOrCreate(['robot_id' => $request['robot_id']],[
            'name' => $request['name'],
            'status' => $request['status']
        ]);

        event( new RobotUpdate($robot));

        return $robot;


    }

    public function orderReceived(Request $request, Order $order)
    {
        $robotId = $request['robot_id'];
        $robot = Robot::where('robot_id','LIKE', "%$robotId%")->first();

        //TODO: Remove this event, the clients are the ones supposed to dismmiss a robot. 
        // event(new RobotCommand($robot, 5));
        $this->sendNotification($order, $robot);
        return 'notification-sent';
    }

    public function dismissRobot(Request $request, Order $order){
        $robotId = $request['robot_id'];
        $robot = Robot::where('robot_id','LIKE', "%$robotId%")->first();
        event(new RobotCommand($robot, 5, 0));
    }

    public function sendOrders(Order $order)
    {
        $robot = Robot::where('status','LIKE','%DISPONIBLE%')->first();
        
        if(isset($robot)){

            event(new RobotCommand($robot, $order->table_id, $order->id));
            $data = [
                'success' => true, 
                'robot' => $robot,
                'order' => $order,
                'message' =>  'La orden '.$order->id.' será entregada por el mesero <b>'.$robot->name.'</b>'
            ];
            $order->update(['status' => 'SENT']);

            return $data;

        }
        $data = [
            'success' => false, 
            'message' =>  'Ocurrio un error al enviar la orden. <br> Verifique que hayan meseros disponibles.'];

        return $data;
        
        
    }

    public function deleteOrder(Order $order){
        $order->delete();
    }
}
