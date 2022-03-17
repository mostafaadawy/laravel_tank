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
            $table->bigIncrements('id');

            $table->string('lineItemId')->unique();

            $table->unsignedBigInteger('category_id')->nullable();
            //$table->foreign('category_id')->references('id')->on('level3_categories')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id')->nullable();
            //$table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->string('image')->nullable();

            $table->enum('unit', ['KG', 'EA']);

            $table->double('final_price');

            $table->double('old_price')->nullable();

            $table->boolean('available')->default(0);

            $table->boolean('featured')->default(0);

            $table->string('quantity_discount')->nullable();

            $table->double('min_quantity')->nullable();

            $table->double('max_quantity')->nullable();

            $table->double('interval')->nullable();

            $table->unsignedBigInteger('deleted_by')->nullable();
            //$table->foreign('deleted_by')->references('id')->on('admins')->onDelete('cascade');

            $table->softDeletes();

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
