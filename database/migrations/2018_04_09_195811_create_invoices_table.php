<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->required();
            $table->string('last_name')->required();
            $table->string('address')->required();
            $table->string('address2')->required();
            $table->string('zipcode')->required();
            $table->string('phone_number')->required();
            $table->string('email')->required();
            $table->longText('products')->required();
            $table->decimal('price', 10, 2)->required();
            $table->integer('taxes');
            $table->boolean('paid')->default(false);

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
        Schema::dropIfExists('invoices');
    }
}
