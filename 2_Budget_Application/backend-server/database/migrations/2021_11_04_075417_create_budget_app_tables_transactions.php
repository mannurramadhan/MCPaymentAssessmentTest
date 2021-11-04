<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetAppTablesTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_app_tables_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_name');
            $table->integer('transaction_category')->unsigned()->nullable();
            $table->integer('income')->nullable();
            $table->integer('expense')->nullable();
            $table->integer('balance');
            $table->timestamps();

            $table->foreign('transaction_category')->references('id')->on('budget_app_tables_transaction_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_app_tables_transactions');
    }
}
