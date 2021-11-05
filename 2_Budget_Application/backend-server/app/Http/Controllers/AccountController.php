<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    function fetchSummary() 
    {
        $user_id = 1;
        $balance = $income = $expense = 0;

        $getBalance = Account::where('user_id', $user_id)->get();
        $getIncomeExpense = Transaction::where('user_id', $user_id)->get();

        foreach($getBalance as $get) {
            $balance += $get->account_balance;
        }

        foreach($getIncomeExpense as $get) {
            $income += $get->income;
            $expense += $get->expense;
        }

        $summary = [
            'balance' => $balance,
            'income' => $income,
            'expense' => $expense
        ];

        return response()->json($summary);
    }
}