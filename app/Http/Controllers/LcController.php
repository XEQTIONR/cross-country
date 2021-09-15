<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Api\LcController as Controller;
use App\Models\Lc;
use Inertia\Inertia;
use Inertia\Response;

class LcController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Lcs', [
            'lcs' => parent::index(),
            'title' => 'Letters of Credit',
        ]);
    }
}
