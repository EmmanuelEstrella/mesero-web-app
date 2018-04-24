<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    protected $fillable = [
        'name',
        'robot_id',
        'status',
    ];

    public function getChannelAttribute(){
        return 'channel-'.$this->attributes['robot_id'];
    }

}
