<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignments', function (Blueprint $table) {
            $table->string('bol', 30)->primary();
            $table->string('lc_num', 15);
            $table->decimal('value', 20,2);
            $table->float('exchange_rate');
            $table->decimal('tax', 10,2)->default(0);
            $table->date('land_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lc_num')->references('lc_num')->on('lcs')
                ->onDelete('restrict');
        });
        // Hack - because float columns in migrations dont work on MySQL 5.7
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE consignments MODIFY exchange_rate FLOAT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consignments');
    }
}
