<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsignmentResource;
use App\Models\Consignment;
use App\Http\Controllers\Api\ConsignmentController as Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConsignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return parent::index();
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
