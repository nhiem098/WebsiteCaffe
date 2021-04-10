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
            $table->boolean('active');
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->unsignedInteger('view')->default(0);
            $table->mediumText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->string('category_id')->default(0);
            $table->string('brand_id')->default(0);
            $table->string('avatar')->nullable();
            $table->text('image')->nullable();
            $table->text('note')->nullable();
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
