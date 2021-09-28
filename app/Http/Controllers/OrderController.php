<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Controllers\Api\OrderController as Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        return Inertia::render('Index', [
            'data' => parent::index($request),
            'title' => 'Orders',
            'labels' => [
                'order_num' => 'Order #',
                'date' => 'Order Date',
                'customerName' => 'Customer',
                'grandTotal' => 'Total',
                'paymentsTotal' => 'Total Payments',
                'balance' => 'Balance',
            ],

            'textRight' => [
                'grandTotal',
                'paymentsTotal',
                'balance'
            ],

        ]);
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
