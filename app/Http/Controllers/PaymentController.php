<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Http\Controllers\Api\PaymentController as Controller;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Payments', ['payments' => parent::index()]);
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
