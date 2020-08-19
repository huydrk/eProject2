<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tensanpham',50)->nullable();
            $table->string('xuatsu',50)->nullable();
            $table->string('thuonghieu',50)->nullable();
            $table->string('images',128)->nullable();
            $table->integer('giagoc')->nullable();
            $table->integer('giagiam');
            $table->text('mota')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
