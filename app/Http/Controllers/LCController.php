<?php

namespace App\Http\Controllers;

use App\Http\Resources\LcResource;
use App\Http\Controllers\Api\LcController as ApiController;
use App\Models\Lc;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LcController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return parent::index();
    }
}
