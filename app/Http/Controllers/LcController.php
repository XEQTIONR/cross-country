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
        return Inertia::render('Index', [
            'data'      => parent::index(),
            'title'     => 'Letters of Credit',
            'labels'    => [
                'lc_num'        => 'LC #',
                'dateIssued'    => 'Issue Date',
                'dateExpiry'    => 'Expiry Date',
                'exchangeRate'  => 'Exchange Rate',
                'foreignAmount' => 'Foreign Amount',
                'domesticAmount'=> 'Domestic Amount',
                //'foreignExpense'=>  'Foreign Expense',
                //'domesticExpense'=> 'Domestic Expense',
                'totalExpense'  => 'Total Expenses',
                //'portDepart'=>      'Departing Port',
                //'portArrive'=>      'Arrival Port',
                'invoiceNumber' => 'Invoice #',
                // 'notes'=>           'Notes',
                'createdAt'     => 'Created On',
            ],
            'textRight'  => [
                'foreignAmount',
                'domesticAmount',
                'exchangeRate',
                'totalExpense'
            ],
        ]);
    }
}
