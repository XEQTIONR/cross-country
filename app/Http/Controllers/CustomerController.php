<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\CustomerController as Controller;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return  Inertia::render('Index', [
            'data' => parent::index(),
            'title' => 'Customers',
            'labels' => [
                'id' => 'ID',
                'name' => 'Customer Name',
                'address' => 'Address',
                'phone' => 'Phone #',
                'grandTotal' => 'Total Orders',
                'paymentsTotal'=> 'Total Payments',
                'balance' => 'Balance'
            ],

            'textRight' => ['grandTotal', 'paymentsTotal', 'balance'],
        ] );
    }
}
