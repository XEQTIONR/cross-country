<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainerContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('container_contents', function (Blueprint $table) {
            $table->id();
            $table->string('container_num');
            $table->foreignId('tyre_id');
            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 10, 3);
            $table->decimal('total_tax', 10, 3);
            $table->decimal('total_weight', 10, 3);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('container_num')->references('container_num')->on('containers')
                ->onDelete('cascade');

            $table->foreign('tyre_id')->references('id')->on('tyres')
                ->onDelete('restrict');

            $table->unique(['container_num', 'tyre_id', 'unit_price']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('container_contents');
    }
}
