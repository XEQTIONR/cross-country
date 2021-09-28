<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Tyre;
use App\Http\Controllers\Api\TyreController as Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TyreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Index', [
            'title' => 'Products',
            'data' => parent::index($request),
            'labels' => [
                'id' => 'ID',
                'brand' => 'Brand',
                'size' => 'Size',
                'pattern' => 'Pattern',
                'lisi' => 'Li/Si',
                'createdAt' => 'Created On'
            ]
        ]);

    }
    /**
     * Display the specified resource.
     *
     * @param  Tyre $tyre
     * @return OrderResource
     */
    public function show(Tyre $tyre)
    {
        return parent::show($tyre);
    }
}
