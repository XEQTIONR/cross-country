<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_contents', function (Blueprint $table) {
            $table->id();
            $table->string('order_num');
            $table->foreignId('container_content_id');
            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_num')->references('order_num')->on('orders')
                ->onDelete('cascade');

            $table->foreign('container_content_id')->references('id')->on('container_contents')
                ->onDelete('restrict');

            $table->unique(['order_num', 'container_content_id', 'unit_price']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_contents');
    }
}
