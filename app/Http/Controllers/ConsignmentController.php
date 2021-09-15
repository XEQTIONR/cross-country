<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsignmentResource;
use App\Models\Consignment;
use App\Http\Controllers\Api\ConsignmentController as Controller;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class ConsignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return  Inertia::render('Consignments', [
            'consignments' => parent::index(),
            'title' => 'Consignments',
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
