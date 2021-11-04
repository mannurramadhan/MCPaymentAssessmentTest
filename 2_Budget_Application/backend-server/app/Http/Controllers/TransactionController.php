<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $transaction = Transaction::all();
        return response()->json($transaction);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'transaction_name' => 'required|string|max:255',
            'transaction_category' => 'required',
            'account_type' => 'required'
        ]);

        // Request variable
        $transaction_name = $request->input('transaction_name');
        $transaction_category = $request->input('transaction_category');
        $income = $request->input('income');
        $expense = $request->input('expense');
        $account_type = $request->input('account_type');

        // Auth user_id
        $user_id = 1;

        // Count balance values
        $transaction = Transaction::where('user_id', $user_id)->latest()->first();
        $account = Account::where('user_id', $user_id)->get();
        $arr_type = [];
        $account_balance = [];
        $balance = $transaction->balance;
    
        foreach ($account as $a) {
            $arr_type[] = $a->account_type;
            $account_balance[$a->account_type] = $a->account_balance;
        }

        if ($income === 0 || $income == NULL) {
            $balance -=  $expense;

            switch ($account_type) {
                case ('Wallet'): 
                    $account_balance[$account_type] -= $expense;
                    break;
                case ('Bank Account'):
                    $account_balance[$account_type] -= $expense;
                    break;
                default : 
                    return response()->json(['message' => 'Account type not found'], 404);
            }

        } elseif ($expense === 0 || $expense == NULL) {
            $balance += $income;

            switch ($account_type) {
                case ('Wallet'): 
                    $account_balance[$account_type] += $income;
                    break;
                case ('Bank Account'):
                    $account_balance[$account_type] += $income;
                    break;
                default : 
                    return response()->json(['message' => 'Account type not found'], 404);
            }
        }

        // Update account balance
        for ($i = 0; $i < count($arr_type); $i++) {
            $update = Account::where('user_id', $user_id);
            $update = $update->where('account_type', $arr_type[$i]);
            $update = $update->first();
            $update = $update->update([
                'account_balance' => $account_balance[$arr_type[$i]]
            ]);

            if (!($update)) return response()->json(['message' => 'Update account balance failed'], 500);
        }

        $transaction = Transaction::create([
            'user_id' => $user_id,
            'transaction_name' => $transaction_name,
            'transaction_category' => $transaction_category,
            'income' => $income,
            'expense' => $expense,
            'balance' => $balance
        ]);

        if ($transaction) return response()->json(['message' => 'Transaction create successfully.', 'data' => $transaction]);
        else return response()->json(['message' => 'Transaction create failed'], 500);
    
    }

}