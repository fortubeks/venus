<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseExpenseItem;
use App\Models\ExpenseItem;
use App\Models\ExpensePayment;
use App\Models\Item;
use Carbon\Carbon;
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
        'supplier_id' => $request->supplier_id,
        'note' => $request->note,
        'category_id' => $request->category_id
        ]);
        foreach($request->description as $key => $description){
            if($request->description[$key] === null){
                continue;
            }
            //if expense category doesn't have item, create item and use the id to create expense item
            $item = ExpenseItem::where('expense_category_id',$request->category_id)->where('name',$description)->first();
            if($item === null){
                $item = ExpenseItem::create([
                    'hotel_id' => auth()->user()->hotel_id,
                    'name' => $description,
                    'expense_category_id' => $request->category_id
                ]);
            }
            
            ExpenseExpenseItem::create([
                'expense_id' => $expense->id,
                'expense_item_id' => $item->id,
                'hotel_id' => auth()->user()->hotel_id,
                'qty' => $request->qty[$key],
                'rate' => $request->rate[$key],
                'amount' => $request->amount[$key],
                'unit_qty' => $request->unit_qty[$key]
            ]);
        }
        if($request->hasFile('uploaded_file')){
            
        }
        return redirect('expenses')->with('success','Expense added successfully');
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
        foreach($request->new_item_amount as $_amount_){
            $amount += $_amount_;
        }
        $expense->update(
        ['category_id' => $request->category_id,
        'expense_date' => $request->expense_date,
        'supplier_id' => $request->supplier_id,
        'amount' => $amount,
        'note' => $request->note
        ]);
        foreach($request->item_id as $key => $item_id){
            $expense_item = ExpenseExpenseItem::find($item_id);
            
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
            
            $item = ExpenseItem::where('expense_category_id',$request->category_id)->where('name',$request->new_item_description[$_key])->first();
            if($item === null){
                $item = ExpenseItem::create([
                    'hotel_id' => auth()->user()->hotel_id,
                    'name' => $request->new_item_description[$_key],
                    'expense_category_id' => $request->category_id
                ]);
            }
            
            ExpenseExpenseItem::create([
                'expense_id' => $expense->id,
                'expense_item_id' => $item->id,
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

    public function filter_Expenses(Request $request){
        $_expenses = Expense::whereBetween('created_at', [$request->filter_from, $request->filter_to]);
        $expenses = $_expenses->paginate(15)->appends([
            'filter_from' => request('filter_from'),
            'filter_to' => request('filter_to'),
            ]);
        $expenses_sum = $_expenses->sum('amount');
        $expenses_count = $_expenses->count();
        return view('expenses.index')->with(compact('expenses','expenses_count','expenses_sum'));
    }

    public function filterExpenses(Request $request){
        // $validatedData = $request->validate([
        //     'start_date' => ['required'],
        //     'end_date' => ['required'],
        // ]);

        $start_date = Carbon::now()->format('Y-m-d');
        $end_date = Carbon::now()->format('Y-m-d');
        
        switch ($request->date_range) {
            case "this-week":
                $start_date = Carbon::now()->startOfWeek()->toDateString();
                $end_date = Carbon::now()->endOfWeek()->toDateString();
                break;
    
            case "last-week":
                $start_date = Carbon::now()->subWeek()->startOfWeek()->toDateString();
                $end_date = Carbon::now()->endOfWeek()->toDateString();
                break;
    
            case "this-month":
                $start_date = Carbon::now()->startOfMonth()->format('Y-m-d');
                $end_date = Carbon::now()->endOfMonth()->format('Y-m-d');
                break;
    
            case "last-month":
                $start_date = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                $end_date = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                break;
    
            case "last-3":
                $start_date = Carbon::now()->subMonths(2)->startOfMonth()->format('Y-m-d');
                $end_date = Carbon::now()->endOfMonth()->format('Y-m-d');
                break;
    
            case "last-6":
                $start_date = Carbon::now()->subMonths(5)->startOfMonth()->format('Y-m-d');
                $end_date = Carbon::now()->endOfMonth()->format('Y-m-d');
                break;
    
            case "this-y":
                $start_date = Carbon::now()->startOfYear()->format('Y-m-d');
                $end_date = Carbon::now()->endOfYear()->format('Y-m-d');
                break;
    
            case "all-time":
                // You might set a reasonable "all-time" range, e.g., the past 5 years
                $start_date = Carbon::now()->subYears(5)->format('Y-m-d');
                $end_date = Carbon::now()->format('Y-m-d');
                break;
    
            // Add more cases for other options as needed
    
            default:
                // Handle the default case or set default date range
                $start_date = Carbon::now()->format('Y-m-d');
                $end_date = Carbon::now()->format('Y-m-d');
                break;
        }
        
        $expense_category = ExpenseCategory::find($request->category_id);

        // $_expenses_query = $expense_category->expenses()->whereBetween('created_at',[$start_date,$end_date])
        // ->when(request('description'), function ($query, $description) {
        //     return $query->where('description', 'like', '%' . $description . '%');
        // });

        // $_expenses_query = $expense_category->expenses()
        // ->whereBetween('created_at', [$start_date, $end_date])
        // ->when(request('description'), function ($query, $description) {
        //     return $query->orWhereHas('items', function ($item) use ($description) {
        //         $item->where('name', 'like', '%' . $description . '%');
        //     });
        // });

        // $_expenses_query = $expense_category->expenses()
        // ->where('hotel_id',auth()->user()->hotel_id)
        // ->whereBetween('created_at', [$start_date, $end_date])
        // ->when(request('description'), function ($query, $description) {
        //     return $query->where(function ($subquery) use ($description) {
        //         $subquery->orWhereHas('items', function ($item) use ($description) {
        //             $item->where('name', 'like', '%' . $description . '%');
        //         })->orWhereHas('expenseItems', function ($expenseItem) use ($description) {
        //             $expenseItem->where('description', 'like', '%' . $description . '%');
        //         });
        //     });
        // });
        $_expenses_query = $expense_category->expenses()
        ->where('hotel_id',auth()->user()->hotel_id)
        ->whereBetween('created_at', [$start_date, $end_date])
        ->when(request('description'), function ($query, $description) {
            return $query->whereHas('expenseItems', function ($item) use ($description) {
                $item->where('name', 'like', '%' . $description . '%');
            });
        });
        //dd($_expenses_query->get());

        $total_amount = $_expenses_query->sum('amount');
        $expenses_count = $_expenses_query->count();
        $average = $expenses_count !== 0 ? $total_amount / $expenses_count : 0;
        $expenses = $_expenses_query->paginate(10)->appends([
            'date_range' => request('date_range'),
            'catgeory_id' => request('catgeory_id'),
            'description' => request('description'),
            'total_amount' => $total_amount,
            'expenses_count' => $expenses_count,
            'average' => $average,
            ]);

        
        return view('pages.expenses.index')->with(compact('total_amount','expenses','average','expenses_count'));
    }
}
