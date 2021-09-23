<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind('orderTotals', function() {

            return DB::select('
                SELECT SUM(B.grandTotal) as grandTotal, SUM(B.paymentsTotal) as paymentsTotal, SUM(B.balance) as balance FROM
                (SELECT orders.order_num,
                       subTotals.subTotal + orders.tax_amount - orders.discount_amount + subTotals.subTotal*(1+((orders.tax_percentage - orders.discount_percentage)/100.0)) as grandTotal,
                       IFNULL(paymentTotals.paymentsTotal,0) as paymentsTotal,
                       subTotals.subTotal + orders.tax_amount - orders.discount_amount + subTotals.subTotal*(1+((orders.tax_percentage - orders.discount_percentage)/100.0)) - IFNULL(paymentTotals.paymentsTotal,0) as balance
                FROM orders
                    LEFT JOIN
                    (SELECT order_num, SUM(qty * unit_price) AS subTotal FROM order_contents GROUP BY order_num) as subTotals
                    ON orders.order_num = subTotals.order_num
                    LEFT JOIN
                    (SELECT order_num, SUM(payment_amount - refund_amount) as paymentsTotal FROM payments GROUP BY order_num) as paymentTotals
                    ON orders.order_num = paymentTotals.order_num) AS B
            ')[0];


        });
    }
}
