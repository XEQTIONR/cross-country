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
        return  Inertia::render('Customers', [ 'customers' => parent::index() ] );
    }
}
