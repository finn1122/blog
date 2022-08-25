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

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->timestamps();
        });



        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("key_cva");
            $table->string("sku")->unique();
            $table->string("title", 250);
            $table->string("descripcion");
            $table->string("key_cva");
            $table->string("group_cva");
            $table->unsignedBigInteger("brands_id");
            $table->foreign("brands_id")->references("id")->on("brands");
            $table->integer("disponible");
            $table->string("condicion");
            $table->string("availability");
            $table->integer("google_product_category");
            $table->integer("fb_product_category");
            $table->string("link");
            $table->integer("disponible_cd");
            $table->string("image_link");
            $table->text("ficha_tecnica")->nullable();
            $table->double("precio");
            $table->string("moneda");
            $table->double("total")->nullable();
            $table->double("bonus")->nullable();
            $table->double("sale_price")->nullable();
            $table->double("price")->nullable();
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

        Schema::dropIfExists('brands');
    }
}
