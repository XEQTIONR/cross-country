<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\WasteController as Controller;
use App\Http\Resources\WasteResource;
use App\Models\Waste;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WasteController extends Controller
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
     * @param  Waste $waste
     * @return WasteResource
     */
    public function show(Waste $waste)
    {
        return parent::show($waste);
    }
}
