<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Order;

class ItemController extends Controller
{
    public function index() {
        return response()->json(Item::query()->orderBy('ordered_at')->get());
    }
}
