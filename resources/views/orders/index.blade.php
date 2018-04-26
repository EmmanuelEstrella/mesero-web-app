@extends('layouts.app')

@push('js')
    <script src="{{ asset('vendor/js/jquery-3.3.1.min.js') }}" defer></script>
    <script src="{{ asset('vendor/js/pusher-4.2.min.js') }}" defer></script>
    <script src="{{ asset('vendor/js/echo.min.js') }}" defer></script>
    <script src="{{ asset('vendor/js/bootstrap.min.js') }}" defer></script>
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
                            <a class="nav-link" id="sent-orders-tab" data-toggle="tab" href="#sent-orders" role="tab" aria-controls="orders" aria-selected="true">Órdenes Enviadas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="robots-tab" data-toggle="tab" href="#robots" role="tab" aria-controls="robots" aria-selected="false">Robots</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">@include('orders.orders')</div>
                        <div class="tab-pane fade " id="sent-orders" role="tabpanel" aria-labelledby="sent-orders-tab">@include('orders.sent-orders')</div>
                        <div class="tab-pane fade" id="robots" role="tabpanel" aria-labelledby="robots-tab">@include('orders.robots')</div>
                      
                    </div>       
                </div>
             
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="lookingFor-modal" tabindex="-1" role="dialog" aria-labelledby="lookingFor-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="lookingFor-modal-label">Enviando Orden</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="looking-robot-msg col-12 text-center">
                            <h4>Buscando algun Mesero disponible.</h4>
                            <h5>Por favor espere...</h5>
                            <div class="fa-3x text-info">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </div>                     
                        </div>
                        <div class="looking-robot-error-msg col-12 text-center d-none">
                            <div class="fa-3x text-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h5 class="message-text">Ocurrio un error al enviar la orden. <br> Verifique la conexion con el servidor.</h5>  
                        </div> 

                        <div class="looking-robot-success-msg col-12 text-center d-none">
                            <div class="fa-3x text-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="message-text">Su orden fue enviada correctamente</h5>
                        </div>

                    </div>   
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn modal-close-btn d-none" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection