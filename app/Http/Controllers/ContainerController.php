<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContainerResource;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Controllers\Api\ContainerController as Controller;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return parent::index();
    }

    /**
     * Display the specified resource.
     * @param  Container $container
     */
    public function show(Container $container)
    {
        return parent::show($container);
    }
}
