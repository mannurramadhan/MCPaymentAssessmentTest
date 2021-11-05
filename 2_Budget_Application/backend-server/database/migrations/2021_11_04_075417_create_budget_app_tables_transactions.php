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
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('transaction_name');
            $table->integer('transaction_category_id')->unsigned()->nullable();
            $table->integer('income')->nullable();
            $table->integer('expense')->nullable();
            $table->integer('balance');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('budget_app_tables_users');
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
