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
            $table->id();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('brand');
            $table->float('price', 12, 2);
            $table->string('model_name');
            $table->text('short_desc');
            $table->text('description');
            $table->tinyInteger('featured')->default(1);
            $table->tinyInteger('available')->default(1);
            $table->tinyInteger('active_flag')->default(1);
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
