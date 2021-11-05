<?php

namespace App\Http\Controllers;

use App\Models\TransactionCategory;
use Illuminate\Http\Request;

class TransactionCategoryController extends Controller
{
    function fetch() 
    {
        $transaction_category = TransactionCategory::orderBy('id', 'asc')->get();
        return response()->json($transaction_category);
    }
}