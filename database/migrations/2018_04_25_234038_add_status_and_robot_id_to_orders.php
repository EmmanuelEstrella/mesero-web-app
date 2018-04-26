<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusAndRobotIdToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['NEW', 'SENT', 'FINISHED'])->default('NEW');
            $table->integer('waiter_robot_id')->unsigned()->nullable();
            $table->foreign('waiter_robot_id')->references('id')->on('robots')->onDelete('set null');
        
        });

         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['waiter_robot_id']);
            $table->dropColumn('status');
            $table->dropColumn('waiter_robot_id');    
        });
      
    }
}
