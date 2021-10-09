<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?? 10;
        return PaymentResource::collection(
            Payment::with('order')
                ->orderByDesc('id')
            ->paginate($perPage)->appends(['perPage' => $perPage])
        )->additional(['meta' => [
            'totals' => Payment::selectRaw('SUM(payment_amount) as paymentAmount, SUM(refund_amount) as refundAmount')
                ->first()
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
     * @param  Payment $payment
     * @return PaymentResource
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment->load('order.contents.containerContent'));
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
