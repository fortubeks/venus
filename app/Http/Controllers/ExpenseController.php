<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseItem;
use App\Models\ExpensePayment;
use App\Models\Item;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Expense $model)
    {
        return view('pages.expenses.index', ['expenses' => $model->orderBy('created_at','desc')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate(  [
            'expense_date' => 'required',
            'category_id' => 'required',
        ]);
        $amount = 0;
        foreach($request->amount as $_amount){
            $amount += $_amount;
        }
        $expense = Expense::create(
        ['hotel_id' => auth()->user()->hotel_id,
        'expense_date' => $request->expense_date,
        'amount' => $amount,
        'note' => $request->note
        ]);
        foreach($request->description as $key => $description){
            if($request->description[$key] === null){
                continue;
            }
            //if expense category doesn't have item, create item and use the id to create expense item
            $item = Item::where('expense_category_id',$request->category_id)->where('name',$description)->first();
            if($item === null){
                $item = Item::create([
                    'hotel_id' => auth()->user()->hotel_id,
                    'name' => $description,
                    'expense_category_id' => $request->category_id
                ]);
            }
            
            ExpenseItem::create([
                'expense_id' => $expense->id,
                'item_id' => $item->id,
                'hotel_id' => auth()->user()->hotel_id,
                'qty' => $request->qty[$key],
                'rate' => $request->rate[$key],
                'amount' => $request->amount[$key],
                'unit_qty' => $request->unit_qty[$key]
            ]);
        }
        if($request->hasFile('uploaded_file')){
            
        }
        return redirect('expenses')->with('status','Expense added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('pages.expenses.show')->with('expense',$expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $amount = 0;
        foreach($request->amount as $_amount){
            $amount += $_amount;
        }
        $expense->update(
        ['category_id' => $request->category_id,
        'expense_date' => $request->expense_date,
        'supplier_id' => $request->supplier_id,
        'amount' => $amount,
        'note' => $request->note
        ]);
        foreach($request->item_id as $key => $item_id){
            $expense_item = ExpenseItem::find($item_id);
            
            $expense_item->update([
                'qty' => $request->qty[$key],
                'rate' => $request->rate[$key],
                'amount' => $request->amount[$key],
                'unit_qty' => $request->unit_qty[$key]
            ]);
        }

        foreach($request->new_item as $_key => $new_item){
            if($request->new_item_description[$_key] === null){
                continue;
            }
            
            $item = Item::where('expense_category_id',$request->category_id)->where('name',$request->new_item_description[$_key])->first();
            if($item === null){
                $item = Item::create([
                    'hotel_id' => auth()->user()->hotel_id,
                    'name' => $request->new_item_description[$_key],
                    'expense_category_id' => $request->category_id
                ]);
            }
            
            ExpenseItem::create([
                'expense_id' => $expense->id,
                'item_id' => $item->id,
                'hotel_id' => auth()->user()->hotel_id,
                'qty' => $request->new_item_qty[$_key],
                'rate' => $request->new_item_rate[$_key],
                'amount' => $request->new_item_amount[$_key],
                'unit_qty' => $request->new_item_unit_qty[$_key]
            ]);
        }

        return redirect('expenses/'.$expense->id)->with('success','Expense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //delete expense items  
        foreach($expense->items as $item){
            $item->delete();
        }
        //delete payments
        foreach($expense->payments as $payment){
            $payment->delete();
        }
        //then delete the expense
        $expense->delete();
        return redirect('expenses')->with('success','Expense deleted successfully');
    }

    public function filterExpenses(Request $request){
        $_expenses = Expense::whereBetween('created_at', [$request->filter_from, $request->filter_to]);
        $expenses = $_expenses->paginate(15)->appends([
            'filter_from' => request('filter_from'),
            'filter_to' => request('filter_to'),
            ]);
        $expenses_sum = $_expenses->sum('amount');
        $expenses_count = $_expenses->count();
        return view('expenses.index')->with(compact('expenses','expenses_count','expenses_sum'));
    }
}
