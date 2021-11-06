<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {

        $transaction = Transaction::leftJoin(
            'budget_app_tables_transaction_categories', 
            'budget_app_tables_transactions.transaction_category_id', 
            '=', 'budget_app_tables_transaction_categories.id'
        );
        $transaction = $transaction->select(
            'budget_app_tables_transactions.*', 
            'budget_app_tables_transaction_categories.name AS transaction_category'
        );
        $transaction = $transaction->orderBy('budget_app_tables_transactions.id', 'asc');
        $transaction = $transaction->get()->toArray();

        // Formatting currency
        for ($i=0; $i < count($transaction); $i++) { 
            $transaction[$i]['income'] = "Rp. " . number_format($transaction[$i]['income'], 0, ".", ".") . ",-";
            $transaction[$i]['expense'] = "Rp. " . number_format($transaction[$i]['expense'], 0, ".", ".") . ",-";
            $transaction[$i]['balance'] = "Rp. " . number_format($transaction[$i]['balance'], 0, ".", ".") . ",-";
        }

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
                default:
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
                default:
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
            'transaction_category_id' => $transaction_category,
            'income' => $income,
            'expense' => $expense,
            'balance' => $balance
        ]);

        if ($transaction) return response()->json(['message' => 'Transaction create successfully.', 'data' => $transaction]);
        else return response()->json(['message' => 'Transaction create failed'], 500);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($transaction);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $this->validate($request, [
            'transaction_name' => 'required|string|max:255',
            'transaction_category' => 'required'
        ]);

        // Auth user_id
        $user_id = 1;

        // Request variable
        $transaction_name = $request->input('transaction_name');
        $transaction_category = $request->input('transaction_category');
        $income = $request->input('income');
        $expense = $request->input('expense');
        $account_type = $request->input('account_type');

        // Count balance values
        $latest = Transaction::where('user_id', $user_id)->latest()->first();
        $account = Account::where('user_id', $user_id);
        $balance = $transaction->balance;
        $get_account = $account->get();
        $arr_type = $account_balance = [];

        foreach ($get_account as $get) {
            $arr_type[] = $get->account_type;
            $account_balance[$get->account_type] = $get->account_balance;
        }

        if ($income === 0 || $income == NULL) {
            $balance += $transaction->expense;
            $balance -=  $expense;

            switch ($account_type) {
                case ('Wallet'):
                    $account_balance[$account_type] += $transaction->expense;
                    $account_balance[$account_type] -= $expense;
                    break;
                case ('Bank Account'):
                    $account_balance[$account_type] += $transaction->expense;
                    $account_balance[$account_type] -= $expense;
                    break;
                default:
                    return response()->json(['message' => 'Account type not found'], 404);
            }
        } elseif ($expense === 0 || $expense == NULL) {
            $balance -= $transaction->income;
            $balance += $income;

            switch ($account_type) {
                case ('Wallet'):
                    $account_balance[$account_type] -= $transaction->income;
                    $account_balance[$account_type] += $income;
                    break;
                case ('Bank Account'):
                    $account_balance[$account_type] -= $transaction->income;
                    $account_balance[$account_type] += $income;
                    break;
                default:
                    return response()->json(['message' => 'Account type not found'], 404);
            }
        }

        // Update account balance
        for ($i = 0; $i < count($arr_type); $i++) {
            $account = Account::where('user_id', $user_id);
            $account = $account->where('account_type', $arr_type[$i]);
            $account = $account->first();
            $account = $account->update([
                'account_balance' => $account_balance[$arr_type[$i]]
            ]);

            if (!($account)) return response()->json(['message' => 'Update account balance failed'], 500);
        }

        // Update transaction balance data
        $transaction = $transaction->update([
            'transaction_name' => $transaction_name,
            'transaction_category_id' => $transaction_category,
            'income' => $income,
            'expense' => $expense,
            'balance' => $balance
        ]);

        if (!($transaction)) return response()->json(['message' => 'Update transaction failed'], 500);

        // Update transaction balance when data is not latest
        if ($id != $latest->id) {
            $id_transaction = $income_transaction = $expense_transaction = $balance_transaction = [];
            $get_transaction = Transaction::where('user_id', $user_id)->where('id', '>=', $id)->orderBy('id', 'asc')->get();

            foreach ($get_transaction as $get) {
                $id_transaction[] = $get->id;
                $income_transaction[] = $get->income;
                $expense_transaction[] = $get->expense;
                $balance_transaction[] = $get->balance;
            }

            for ($i = 1; $i < count($id_transaction); $i++) {
                $update_balance = Transaction::where('user_id', $user_id)->where('id', $id_transaction[$i]);
                if ($income_transaction[$i] != 0 || $expense_transaction[$i] == 0) {
                    $update_balance->update([
                        'balance' => $balance_transaction[$i - 1] + $income_transaction[$i]
                    ]);
                } elseif ($income_transaction[$i] == 0 || $expense_transaction[$i] != 0) {
                    $update_balance->update([
                        'balance' => $balance_transaction[$i - 1] - $expense_transaction[$i]
                    ]);
                } else {
                    return response()->json(['message' => 'Update transaction failed'], 500);
                }
            }

        }

        return response()->json(['message' => 'Transaction updated successfully.', 'data' => $transaction]);
    
    }

}
