<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Tyre;
use App\Http\Controllers\Api\TyreController as Controller;
use Inertia\Inertia;

class TyreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return Inertia::render('Tyres', [
            'title' => 'Products',
            'tyres' => parent::index(),
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
