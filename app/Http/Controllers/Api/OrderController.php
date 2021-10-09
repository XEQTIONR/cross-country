<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderContent;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        return OrderResource::collection(Order::with(['customer', 'payments','contents'])
            ->addSelect([
                'grandTotal' => OrderContent::selectRaw('IFNULL(SUM(qty * unit_price), 0)
                *(1+((tax_percentage-discount_percentage)/100.0)) + tax_amount - discount_amount')
                    ->whereColumn('order_num', 'orders.order_num')
                    ->groupBy('order_num')
                    ->limit(1),
                'paymentsTotal' => Payment::selectRaw('SUM(payment_amount - refund_amount)')
                    ->whereColumn('order_num', 'orders.order_num')
                    ->groupBy('order_num')
                    ->limit(1),

                'customerName' => Customer::select('name')->whereColumn('id', 'orders.customer_id')
            ])
            ->orderByRaw('(IFNULL(grandTotal,0) - IFNULL(paymentsTotal,0)) DESC')
            ->paginate($perPage)->appends(['perPage' => $perPage]))
            ->additional(['meta' => [
                'totals' => resolve('orderTotals')
            ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        return new OrderResource($order->load('customer', 'contents.containerContent', 'payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
