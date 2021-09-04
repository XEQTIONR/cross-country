<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste', function (Blueprint $table) {
            $table->id();
            $table->foreignId('container_content_id');
            $table->foreignId('tyre_id');
            $table->integer('qty');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tyre_id')->references('id')->on('tyres')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wastes');
    }
}
