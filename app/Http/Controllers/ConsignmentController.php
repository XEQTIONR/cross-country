<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsignmentResource;
use App\Models\Consignment;
use App\Http\Controllers\Api\ConsignmentController as Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ConsignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return  Inertia::render('Index', [
            'data' => parent::index($request),
            'title' => 'Consignments',
            'searchKey' => 'consignment',
            'labels'    => [
                'bol'           => 'BOL',
                'lcNum'         => 'LC #',
                'landDate'      => 'Date Landed',
                'value'         => 'Value (Foreign)',
                'localValue'    => 'Value (TK)',
                'tax'           => 'Tax',
                'createdAt'     => 'Created On',
            ],

            'textRight' => [
                'value',
                'localValue',
                'tax',
            ],

        ] );
    }

    /**
     * Display the specified resource.
     *
     * @param Consignment $consignment
     * @return ConsignmentResource
     */
    public function show(Consignment $consignment)
    {
        return parent::show($consignment);
    }
}
