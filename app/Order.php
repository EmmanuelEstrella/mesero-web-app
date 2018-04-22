<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client',
        'delivered_at',
        'token'
    ];

    public function items() {
        return $this->belongsToMany('App\Item', 'order_items', 'order_id', 'item_id')->withPivot('quantity');
    }

    public function getSubTotalAttribute() {
        $subTotal = 0.00;
        foreach($this->items as $item) {
            $subTotal += $item->pivot->quantity * $item->price;
        }
        return $subTotal;
    }

    public function getTotalAttribute() {
        return round($this->sub_total * 1.28, 2);
    }
}
