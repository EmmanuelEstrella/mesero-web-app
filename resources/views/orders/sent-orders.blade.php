

<div class="">
    <div class="row justify-content-center">
        <div class="col-12" >
                <div class="col-12 mt-4">
                    <legend>Órdenes Enviadas</legend>
                    <hr>
                </div>
               
                <div id="sent-orders-holder"  class="col-12">
                    <!-- Input orders here. -->
                    {{-- Template Start --}}
                    @foreach ($sentOrders as $order)
                        <div id="order-{{$order->id}}" class="card mt-3">
                            <div class="card-header row no-gutters">
                                <div class="col-6">
                                    <b class="client">Mesa No. {{$order->table_id}}</b>
                                    <span class="badge badge-primary status ">{{$order->status}}</span>
                                </div>
                                <div class="col-6 text-right">
                                    No. de Orden: <b class="created_at">{{$order->id}}</b>
                                </div>
                            </div>
                            <div class="card-body row">
                                <div class="col-12">
                                    <ul class="items row">
                                        @for ($i = 0; $i < count($order->items); $i++)
                                            
                                            <li class="col-6 {{ $i%2 != 0 ? text-right : ''}}">
                                                <b class="item-name">{{$order->items[$i]->name}}</b> - Cnt: {{$order->items[$i]->pivot->quantity}}
                                                
                                            </li>
                
                                        @endfor
                                       
                                    </ul>
                                </div>
                                <div class="col-12 no-gutters text-right">
                                    <hr>
                                    <div class="row">
                                        <div class="col-9 no-gutters">
                                            Sub Total: 
                                        </div>
                                        <div class="col-3 no-gutters">
                                            <b class="sub-total">${{$order->sub_total}}</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-9 no-gutters">
                                            Impuestos (10 + 18)%:
                                        </div>
                                        <div class="col-3 no-gutters">
                                            <b class="tax">${{$order->taxes}}</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-9 no-gutters">
                                            Total:
                                        </div>
                                        <div class="col-3 no-gutters">
                                            <b class="total">${{$order->sub_total}}</b>
                                        </div>
                                    </div>
                                    <div class="row mt-4 d-none">
                        
                                        <div class="offset-md-9 col-md-3">
                                            <button class="btn btn-block btn-info order-send-btn" data-order-id="{{$order->id}}">Enviar Orden</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                   
                    {{-- Template End --}}
                </div>
          
        </div>
    </div>
</div>
