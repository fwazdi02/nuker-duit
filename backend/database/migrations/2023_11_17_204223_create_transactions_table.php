<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->enum('type', array('buy', 'sell'));
            $table->decimal('amount', 5, 2)->unsigned();
            $table->double('rate', 12, 10)->unsigned();
            $table->double('idr_amount', 12, 2)->unsigned();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}