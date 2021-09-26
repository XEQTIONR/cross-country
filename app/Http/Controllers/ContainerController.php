<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Http\Controllers\Api\ContainerController as Controller;
use Inertia\Inertia;
use Inertia\Response;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Containers', [ 'containers' => parent::index() ]);
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
