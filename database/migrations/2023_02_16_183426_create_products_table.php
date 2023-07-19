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
            $table->string('name');
            $table->string('image')->nullable();
            $table->double('purchase_price',8,2);
            $table->double('sale_price',8,2)->nullable();
            $table->integer('stock');
            $table->foreignId('category_id')->constrained('categories','id')->cascadeOnDelete();
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
