<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ConsignmentResource;
use App\Http\Controllers\Controller;
use App\Models\Consignment;
use App\Models\Lc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SearchController extends Controller
{
    protected $entities = [
        'consignment'
    ];


    public function index(Request $request) {

        switch($request->input('entity')) {

            case 'lc' :
                return Lc::search($request->input('query'));
            case 'consignment' :
                return Consignment::search($request->input('query'));

        }

    }
}
