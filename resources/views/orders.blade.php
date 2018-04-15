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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orders</div>
                <div id="orders" class="card-body">
                    <!-- Input orders here. -->
                    {{-- Template Start --}}
                    <div id="order-card-template" class="card d-none">
                        <div class="card-header row no-gutters">
                            <div class="col-6">
                                   <b class="client">Order No. 1</b> 
                            </div>
                            <div class="col-6 text-right">
                                   No. de Orden: <b class="created_at">ID</b>
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="col-12">
                                <div class="items row">
                                    <li class="col-6">Elem 1</li>
                                    <li class="col-6 text-right">Elem 1</li>
                                    <li class="col-6">Elem 1</li>
                                </div>
                            </div>
                            <div class="col-12 no-gutters text-right">
                                <hr>
                                <div class="row">
                                    <div class="col-9 no-gutters">
                                        Sub Total: 
                                    </div>
                                    <div class="col-3 no-gutters">
                                        <b class="sub-total">$0.00</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9 no-gutters">
                                        Impuestos (10 + 18)%: 
                                    </div>
                                    <div class="col-3 no-gutters">
                                        <b class="tax">$0.00</b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9 no-gutters">
                                        Total: 
                                    </div>
                                    <div class="col-3 no-gutters">
                                        <b class="total">$0.00</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    {{-- Template End --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection