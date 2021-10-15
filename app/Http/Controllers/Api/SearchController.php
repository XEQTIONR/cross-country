<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ConsignmentResource;
use App\Http\Controllers\Controller;
use App\Models\Consignment;
use App\Models\Customer;
use App\Models\Lc;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Tyre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SearchController extends Controller
{
    protected $entities = [
        'consignment'
    ];


    public function index(Request $request) {

        $query = $request->input('query');
        switch($request->input('entity')) {
            case 'lc':
                return Lc::search($query);
            case 'consignment' :
                return Consignment::search($query);
            case 'order':
                return Order::search($query);
            case 'payment':
                return Payment::search($query);
            case 'customer':
                return Customer::search($query);
            case 'tyre':
                return Tyre::search($query);
        }

    }
}
