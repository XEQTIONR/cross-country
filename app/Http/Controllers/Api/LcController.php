<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LcResource;
use App\Models\Lc;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class LcController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return LcResource::collection(Lc::orderByDesc('created_at')->paginate(10))
            ->additional(['meta' => [
                'totals' => Lc::selectRaw('
                    SUM(foreign_amount) as foreignAmount,
                    SUM(foreign_amount * exchange_rate) AS domesticAmount,
                    SUM(foreign_expense*exchange_rate + domestic_expense) AS totalExpense'
                )->first()
            ]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Lc $lc): LcResource
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Lc $lc
     * @return LcResource
     */
    public function show(Lc $lc)
    {
        return new LcResource($lc->load('consignments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
