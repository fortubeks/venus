<?php

namespace App\Http\Controllers;

use App\Models\ExpensePayment;
use Illuminate\Http\Request;

class ExpensePaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'expense_id' => 'required',
            'date_of_payment' => 'required',
        ]);
        ExpensePayment::create($request->all());
        return redirect('expenses')->with('success','Payment added successfully');
    }
}
