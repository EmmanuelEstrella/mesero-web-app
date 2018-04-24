
<div class="">
    <div class="row">
        <div class="col-md-12 row">
                <div class="col-12 mt-4">
                    <legend>Robots Registrados</legend>
                    <hr>
                </div>
               
                <div class="col mt-4">
                    <h5 class="font-weight-light">Nombre:</h5>
                </div>
                <div class="col mt-4">
                    <h5 class="font-weight-light">Estado:</h5>
                </div>
                
                
                <div id="robots-holder" class="list-group col-12 px-2 ">
                    <!-- Input robots here. -->
                    {{-- Template Start --}}
                   
                    @foreach ($robots as $robot)
                        <a href="#" id="robot-{{ $robot->robot_id }}" class=" list-group-item list-group-item-action ">
                            <div class="row">
                                <div class="col">
                                    <h4 class="robot-name font-weight-light">{{ $robot->name }}</h4>
                                </div>
                                <div class="col">
                                    <h4 class="robot-status">{{ $robot->status }} </h4>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    <a href="#" class="robot-template list-group-item list-group-item-action d-none">
                      <div class="row">
                            <div class="col">
                                <h4 class="robot-name font-weight-light">R2D2</h4>
                            </div>
                            <div class="col">
                                <h4 class="robot-status">Disponible </h4>
                            </div>
                        </div>
                    </a>
                       
                  
                   
                   
                    {{-- Template End --}}
                </div>
        </div>
    </div>
</div>