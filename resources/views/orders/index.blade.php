@extends('layouts.app')

@push('js')
    <script src="{{ asset('vendor/js/jquery-3.3.1.min.js') }}" defer></script>
    <script src="{{ asset('vendor/js/pusher-4.2.min.js') }}" defer></script>
    <script src="{{ asset('vendor/js/echo.min.js') }}" defer></script>
    <script src="{{ asset('js/socket.js') }}" defer></script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card ">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true">Nuevas Órdenes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="robots-tab" data-toggle="tab" href="#robots" role="tab" aria-controls="robots" aria-selected="false">Robots</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">@include('orders.orders')</div>
                        <div class="tab-pane fade" id="robots" role="tabpanel" aria-labelledby="robots-tab">@include('orders.robots')</div>
                      
                    </div>       
                </div>
             
            </div>
        </div>
    </div>
</div>
@endsection