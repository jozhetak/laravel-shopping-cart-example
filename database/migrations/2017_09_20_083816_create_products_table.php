<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name')->unique();
            $table->boolean('holiday_special')->default(false);
            $table->unsignedInteger('option_group_id')->nullable()->default(null)->index();
            $table->unsignedInteger('second_option_group_id')->nullable()->default(null)->index();
            $table->unsignedInteger('category_id')->index();
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('price');
            $table->string('image');
            $table->timestamps();

            $table->foreign('option_group_id')->references('id')->on('option_groups')->onDelete('cascade');
            $table->foreign('second_option_group_id')->references('id')->on('second_option_groups')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
