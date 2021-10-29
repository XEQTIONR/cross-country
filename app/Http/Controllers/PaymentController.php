<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Http\Controllers\Api\PaymentController as Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Index', [
            'data'      => parent::index($request),
            'labels'    => [
                'id'            => 'Payment ID',
                'order_num'     => 'Order #',
                'paymentAmount' => 'Amount Paid',
                'refundAmount'  => 'Amount Refunded',
                'createdAt'     => 'Payment On',
            ],
            'searchKey' => 'payment',
            'textRight' => [
                'paymentAmount',
                'refundAmount',
            ],
            'title'     => 'Payments',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Payment $payment
     * @return PaymentResource
     */
    public function show(Payment $payment)
    {
        return parent::show($payment);
    }
}
