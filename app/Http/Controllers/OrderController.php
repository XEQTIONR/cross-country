<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\OrderController as Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return parent::index();
    }

    /**
     * Display the specified resource.
     *
     * @param  Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        return parent::show($order);
    }
}
