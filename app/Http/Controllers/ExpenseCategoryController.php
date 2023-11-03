<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpenseCategory $model)
    {
        return view('pages.expense-categories.index', ['expense_categories' => $model->where('hotel_id',auth()->user()->hotel_id)->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.expense-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense_categories = ExpenseCategory::create([ 
            'name' => $request->name,
            'parent_id' => $request->category,
            'hotel_id' => auth()->user()->hotel_id,
        ]);
        return redirect('expense-categories')->with('success','Expense Category was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expense_categories
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expense_category)
    {
        return view('pages.expense-categories.show')->with('expense_category',$expense_category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseCategory  $expense_categories
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expense_categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseCategory  $expense_categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expense_category)
    {
        $expense_category->update($request->all());
        return redirect('expense-categories')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseCategory  $expense_categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ExpenseCategory $expense_category)
    {
        $expense_category->delete();
        return redirect('expense-categories')->with('success','Category deleted successfully');
    }
}
