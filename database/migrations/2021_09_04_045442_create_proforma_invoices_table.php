<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proforma_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('lc_num', 15);
            $table->foreignId('tyre_id');
            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lc_num')->references('lc_num')->on('lcs')
                ->onDelete('cascade');

            $table->foreign('tyre_id')->references('id')->on('tyres')
                ->onDelete('restrict');

            $table->unique(['lc_num', 'tyre_id', 'unit_price']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proforma_invoices');
    }
}
