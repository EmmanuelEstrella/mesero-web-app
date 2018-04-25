var socket = function () {
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: 'f98a0844733d0b3485c0',
        encrypted: true
    });

    console.log("Initialized Echo");
    console.log(window.Echo);
    console.log("Initialized Pusher");
    console.log(window.Pusher);

    var getOrders = function() {
        $.ajax({
            url: '/api/orders',
            method: 'GET',
            success: function(orders) {
                console.log(orders);
            }
        });
    }

    getOrders();
    var $lookingForModal = $('#lookingFor-modal');
    var $lookingMessage = $lookingForModal.find('.looking-robot-msg');
    var $lookingSuccessMessage = $lookingForModal.find('.looking-robot-success-msg');
    var $lookingErrorMessage = $lookingForModal.find('.looking-robot-error-msg');
    var $lookingCloseBtn = $lookingForModal.find('.modal-close-btn');
  

    var sendOrder = function( orderId)
    {
        console.log('order', orderId);
        $lookingMessage.removeClass('d-none');
        $lookingSuccessMessage.addClass('d-none');
        $lookingErrorMessage.addClass('d-none');
        $lookingCloseBtn.addClass('d-none');

        $lookingForModal.modal({
            keyboard: false,
            backdrop: 'static'
        });

        $.ajax({
            url: '/orders/' + orderId + '/send/',
            method: 'GET',
            success: function(data, textStatus, jqXHR){
                $lookingMessage.addClass('d-none');

                if(data.success){
                    var robot = data.robot;
                    var order = data.order;
                    $lookingSuccessMessage.removeClass('d-none');
                    $lookingSuccessMessage.find('.message-text').html(data.message);
                }else{
                    $lookingErrorMessage.removeClass('d-none');
                    $lookingErrorMessage.find('.message-text').html(data.message);
                   
                }
                $lookingCloseBtn.removeClass('d-none');
               

            },
            error: function(jqXHR, textStatus, errorThrown){
                $lookingMessage.addClass('d-none');
                $lookingErrorMessage.find('.message-text').html("Ocurrio un error al enviar la orden. <br> Verifique la conexion con el servidor.")
                $lookingErrorMessage.removeClass('d-none');
                $lookingCloseBtn.removeClass('d-none');
               
            }
        });
    
    }
    var listen = function() {
        window.Echo.channel('orders').listen('NewOrder', function(json) {
            console.log("Received Data");
            console.log(json);
            var result = json;
            var order = result.order;
            var sub_total = result.sub_total;
            var total = result.total;

            var $holder = $('#orders-holder');
            var $template = $('#order-card-template').clone();
            $template.find('.client').first().html(order.client);
            $template.find('.created_at').first().html(order.id);
            $template.find('.sub-total').first().html('$' + sub_total);
            $template.find('.tax').first().html('$' + (Math.round(sub_total * 28) / 100));
            $template.find('.total').first().html('$' + total);
            $template.find('.order-send-btn').first().on('click', function(e){
                sendOrder(order.id);
            });
            var totalItems = order.items.length;

            var $itemDiv = $template.find('.items').first();
            $itemDiv.html('');
            for(var i = 0; i < totalItems; i++) {
                var $newItem = $('<li class="col-6"></li>');
                if(i%2 != 0) {
                    $newItem.addClass('text-right');
                }
                $newItem.append('<b class="item-name">' +  order.items[i].name + "</b> - Cnt: " + order.items[i].pivot.quantity);
                $itemDiv.append($newItem);
            }
            $holder.prepend($template);
            $template.fadeIn();
            $template.removeClass('d-none');
        });


        window.Echo.channel('orders').listen('RobotUpdate', function (json) {
            console.log("Received Data");
            console.log(json);
            var result = json;
            var robotId = result.robot_id;
            var robotName = result.name;
            var robotStatus = result.status;
            var $existingRobot = $('#robot-' + robotId);
            if( $existingRobot.length ){
                $existingRobot.find('.robot-name').first().html(robotName);
                $existingRobot.find('.robot-status').first().html(robotStatus);
            }else{
                var $holder = $('#robots-holder');
                var $template = $('#robot-template').clone();
                $template.find('.robot-name').first().html(robotName);
                $template.find('.robot-status').first().html(robotStatus);
                $template.attr('id', 'robot-'+robotId);
                $holder.prepend($template);
                $template.fadeIn();
                $template.removeClass('d-none');
            }
           
        });
    }

    listen();
}

$(function(){
    socket();
})