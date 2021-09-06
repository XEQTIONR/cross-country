<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcs', function (Blueprint $table) {
            $table->string('lc_num', 15)->primary();
            $table->date('date_issued');
            $table->date('date_expiry');
            $table->string('applicant');
            $table->string('beneficiary');
            $table->string('currency_code', 5);
            $table->decimal('foreign_amount', 10, 2)->default(0);
            $table->decimal('foreign_expense', 10, 2)->default(0);
            $table->decimal('domestic_expense', 10, 2)->default(0);
            $table->float('exchange_rate')->default(0);
            $table->string('port_depart', 30);
            $table->string('port_arrive', 30);
            $table->string('invoice_num', 30)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Hack - because float columns in migrations dont work on MySQL 5.7
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE lcs MODIFY exchange_rate FLOAT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lcs');
    }
}
